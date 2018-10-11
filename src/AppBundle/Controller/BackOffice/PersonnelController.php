<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Personnel;
use AppBundle\Form\PersonnelType;
use AppBundle\Form\UpdatePersonnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Personnel")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class PersonnelController extends Controller
{
    /**
     * @Route("/List", name="Personnel_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personnels = $em->getRepository('AppBundle:Personnel')->findAll();
        return $this->render('Personnel/List.html.twig', array('personnels' => $personnels));
    }

    /**
     * @Route("/Add", name="Personnel_Add")
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $personnel= new Personnel();
        $form = $this->createForm( PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $personnel->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('Personnel_directory'),
                $fileName);
            $personnel->setImage($fileName);
            $em->persist($personnel);
            $em->flush();
            return $this->redirectToRoute("Personnel_list");
        }
        return $this->render('Personnel/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/Update/{id}", name="Personnel_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $personnel = $em->getRepository('AppBundle:Personnel')->find($id);
        $personnelImage = $personnel->getImage();

        $form = $this->createForm(UpdatePersonnelType::class, $personnel);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $personnel->getImage();
            if ($file!= null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('Personnel_directory'),
                    $fileName);
                $personnel->setImage($fileName);
            }else{
                $personnel->setImage($personnelImage);
            }
            $em->persist($personnel);
            $em->flush();

            return ($this->redirectToRoute("Personnel_list"));
        }

        return $this->render('Personnel/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Personnel_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $personnel= $em->getRepository('AppBundle:Personnel')->find($id);
        $em->remove($personnel);
        $em->flush();
        return $this->redirectToRoute("Personnel_list");
    }

}