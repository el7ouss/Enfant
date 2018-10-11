<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Actualite;
use AppBundle\Form\ActualiteType;
use AppBundle\Form\UpdateActualiteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Actualite")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class ActualiteController extends Controller
{
    /**
     * @Route("/List", name="Actualite_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('AppBundle:Actualite')->findAll();
        return $this->render('Actualité/List.html.twig', array('actualites' => $actualites));
    }

    /**
     * @Route("/Add", name="Actualite_Add")
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $actualite= new Actualite();
        $form = $this->createForm( ActualiteType::class, $actualite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $actualite->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('Actualite_directory'),
                $fileName);
            $actualite->setPhoto($fileName);
            $em->persist($actualite);
            $em->flush();
            return $this->redirectToRoute("Actualite_list");
        }
        return $this->render('Actualité/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/Update/{id}", name="Actualite_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $actualite = $em->getRepository('AppBundle:Actualite')->find($id);
        $actualiteImage = $actualite->getPhoto();

        $form = $this->createForm(UpdateActualiteType::class, $actualite);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $actualite->getPhoto();
            if ($file!= null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('Actualite_directory'),
                    $fileName);
                $actualite->setPhoto($fileName);
            }else{
                $actualite->setPhoto($actualiteImage);
            }
            $em->persist($actualite);
            $em->flush();

            return ($this->redirectToRoute("Actualite_list"));
        }

        return $this->render('Actualité/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Actualite_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $actualite= $em->getRepository('AppBundle:Actualite')->find($id);
        $em->remove($actualite);
        $em->flush();
        return $this->redirectToRoute("Actualite_list");
    }

}