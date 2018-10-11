<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Adhesion;
use AppBundle\Entity\Eleve;
use AppBundle\Form\AdhesionType;
use AppBundle\Form\UpdateAdhesionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("Adhesion")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class AdhesionController extends Controller
{
    /**
     * @Route("/List", name="Adhesion_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adhesion = $em->getRepository('AppBundle:Adhesion')->findAll();

        return $this->render('Adhesion/List.html.twig', ['adhesion' => $adhesion]);
    }

    /**
     * @Route("/{id}/List", name="AdhesionEleve_list")
     */
    public function ListAdhesionAction(Eleve $eleve)
    {
        $em = $this->getDoctrine()->getManager();
        $adhesion = $em->getRepository('AppBundle:Adhesion')->findBy(["eleve" => $eleve], ["id" => "desc"]);

        return $this->render('Adhesion/List.html.twig', ['adhesion' => $adhesion,"eleve"=>$eleve]);
    }

    /**
     * @Route("/{id}/Add", name="Adhesion_Add")
     */
    public function addAction(Eleve $eleve, Request $request){

        $em = $this->getDoctrine()->getManager();
        $adhesion1 = $em->getRepository(Adhesion::class)->findOneBy(['enable' => true]);
        if ($adhesion1!=null)
            $adhesion1->setEnable(false);

        $adhesion = new Adhesion();
        $adhesion->setEleve($eleve);
        $adhesion->setEnable(true);
        $form = $this->createForm(AdhesionType::class, $adhesion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adhesion);
            $em->flush();
            return $this->redirectToRoute("AdhesionEleve_list",["id"=>$eleve->getId()]);
        }

        return $this->render('Adhesion/Add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/Update/{id}", name="Adhesion_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $adhesion = $em->getRepository('AppBundle:Adhesion')->find($id);
        $form = $this->createForm(UpdateAdhesionType::class, $adhesion);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($adhesion);
            $em->flush();

            return ($this->redirectToRoute("AdhesionEleve_list",["id"=>$adhesion->getEleve()->getId()]));
        }

        return $this->render('Adhesion/Update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/Delete/{id}", name="Adhesion_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $adhesion= $em->getRepository('AppBundle:Adhesion')->find($id);
        $em->remove($adhesion);
        $em->flush();
        return $this->redirectToRoute("AdhesionEleve_list");
    }

}