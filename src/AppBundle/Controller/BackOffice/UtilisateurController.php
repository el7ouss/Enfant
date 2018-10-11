<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("Personnel")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class UtilisateurController extends Controller
{
    /**
     * @Route("/List", name="Utilisateur_list")

     */
    public function ListAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $Users = $userManager->findUsers();
        return $this->render('Utilisateur/List.html.twig', array(
            'Users' => $Users,
        ));
    }

    /**
     * @Route("/Add", name="Utilisateur_Add")
     */
    public function AddAction(Request $request)
    {

        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = new User();
        $user->setEnabled(true);
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(RegistrationType::class);
        $form->setData($user);

        $form->handleRequest($request);


        if ($form->isValid()) {
            $file = $user->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('User_directory'),
                $fileName);
            $user->setImage($fileName);
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('Utilisateur_list');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

        if (null !== $response = $event->getResponse()) {
            return $response;
        }

        return $this->render('Utilisateur/Add.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/Delete/{id}", name="Utilisateur_delete")
     */
    public function DeleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $user= $em->getRepository('AppBundle:User')->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('Utilisateur_list');
    }

    public function findByRole($role)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('user')
            ->from("AppBundle:User", 'user')
            ->where('user.roles LIKE :roles')
            ->setParameter('roles', '%"' . $role . '"%');

        return $qb->getQuery()->getResult();
    }
}