<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Personnel;
use AppBundle\Entity\Salaire;
use AppBundle\Form\SalaireType;
use AppBundle\Form\UpdateSalaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Salaire")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class SalaireController extends Controller
{
    /**
     * @Route("/List", name="Salaire_list")
     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $salaire = $em->getRepository('AppBundle:Salaire')->findAll();

        return $this->render('Salaire/List.html.twig', ['salaire' => $salaire]);
    }

    /**
     * @Route("/{id}/List", name="SalairePersonnel_list")
     */
    public function ListSalaireAction(Personnel $personnel)
    {
        $em = $this->getDoctrine()->getManager();
        $salaire = $em->getRepository('AppBundle:Salaire')->findBy(["personnel" => $personnel], ["id" => "desc"]);

        return $this->render('Salaire/List.html.twig', ['salaire' => $salaire,"personnel"=>$personnel]);
    }

    /**
     * @Route("/{id}/Add", name="Salaire_Add")
     */
    public function addAction(Personnel $personnel, Request $request){

        $em = $this->getDoctrine()->getManager();

        $salaire= new Salaire();
        $salaire->setPersonnel($personnel);
        $form = $this->createForm( SalaireType::class, $salaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($salaire);
            $em->flush();
            return $this->redirectToRoute("SalairePersonnel_list",["id"=>$personnel->getId()]);
        }
        return $this->render('Salaire/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/Update/{id}", name="Salaire_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $seance = $em->getRepository('AppBundle:Salaire')->find($id);
        $form = $this->createForm(UpdateSalaireType::class, $seance);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($seance);
            $em->flush();

            return ($this->redirectToRoute("SalairePersonnel_list",["id"=>$seance->getPersonnel()->getId()]));
        }

        return $this->render('Salaire/Update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/Delete/{id}", name="Salaire_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $salaire= $em->getRepository('AppBundle:Salaire')->find($id);
        $em->remove($salaire);
        $em->flush();
        return $this->redirectToRoute("SalairePersonnel_list");
    }

}
