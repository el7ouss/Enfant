<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Adhesion;
use AppBundle\Entity\Paiement;
use AppBundle\Form\PaiementType;
use AppBundle\Form\UpdatePaiementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Paiement")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class PaiementController extends Controller
{
    /**
     * @Route("/List", name="Paiement_list")
     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $paiement = $em->getRepository('AppBundle:Paiement')->findAll();

        return $this->render('Paiement/List.html.twig', ['paiement' => $paiement]);
    }

    /**
     * @Route("/{id}/List", name="PaiementAdhesion_list")
     */
    public function ListPaiementAction(Adhesion $adhesion)
    {
        $em = $this->getDoctrine()->getManager();
        $paiement = $em->getRepository('AppBundle:Paiement')->findBy(["adhesion" => $adhesion], ["id" => "desc"]);

        return $this->render('Paiement/List.html.twig', ['paiement' => $paiement,"adhesion"=>$adhesion]);
    }

    /**
     * @Route("/{id}/Add", name="Paiement_Add")
     */
    public function addAction(Adhesion $adhesion, Request $request){

        $em = $this->getDoctrine()->getManager();

        $paiement= new Paiement();
        $paiement->setAdhesion($adhesion);
        $form = $this->createForm( PaiementType::class, $paiement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($paiement);
            $em->flush();
            return $this->redirectToRoute("PaiementAdhesion_list",["id"=>$adhesion->getId()]);
        }
        return $this->render('Paiement/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/Update/{id}", name="Paiement_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $paiement = $em->getRepository('AppBundle:Paiement')->find($id);
        $form = $this->createForm(UpdatePaiementType::class, $paiement);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($paiement);
            $em->flush();

            return ($this->redirectToRoute("PaiementAdhesion_list",["id"=>$paiement->getAdhesion()->getId()]));
        }

        return $this->render('Paiement/Update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/Delete/{id}", name="Paiement_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $paiement= $em->getRepository('AppBundle:Paiement')->find($id);
        $em->remove($paiement);
        $em->flush();
        return $this->redirectToRoute("PaiementAdhesion_list");
    }

}
