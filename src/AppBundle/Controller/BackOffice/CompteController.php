<?php

namespace AppBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\UpdateProfileType;
use AppBundle\Form\UpdateUserType;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * @Route("Compte")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class CompteController extends Controller
{
    /**
     * @Route("/Profile", name= "Compte_Profile"  )
     *
     */
    public function ProfileAction(){
        return $this->render('Compte/Profile.html.twig');
    }
    /**
     * @Route("/Update/{id}", name= "Compte_update"  )
     */
    public function UpdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $userImage = $user->getImage();

        $form = $this->createForm(UpdateProfileType::class, $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $user->getImage();
            if ($file!= null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('User_directory'),
                    $fileName);
                $user->setImage($fileName);
            }else{
                $user->setImage($userImage);
            }
            $em->persist($user);
            $em->flush();
            return ($this->redirectToRoute("Compte_Profile"));
        }
        return $this->render(':Compte:Update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/Compte/ChangePassword", name= "Compte_password_change"  )
     */
    public function changePasswordAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.change_password.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('Compte_Profile');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render(':Compte:ChangePassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
