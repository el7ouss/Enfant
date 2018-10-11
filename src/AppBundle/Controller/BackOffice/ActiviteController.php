<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Groupe;
use AppBundle\Form\ActiviteType;
use AppBundle\Form\UpdateActiviteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Activite")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class ActiviteController extends Controller
{
    /**
     * @Route("/List", name="Activite_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activite = $em->getRepository('AppBundle:Activite')->findAll();
        return $this->render('Activité/List.html.twig', ['activite' => $activite]);
    }

    /**
     * @Route("/{id}/List", name="ActiviteGroupe_list")
     */
    public function ListSalaireAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository('AppBundle:Activite')->findBy(["groupe" => $groupe], ["id" => "desc"]);

        return $this->render('Activité/List.html.twig', ['groupe' => $groupe, "activite"=>$activite]);
    }

    /**
     * @Route("/{id}/Add", name="Activite_Add")
     */
    public function addAction(Groupe $groupe, Request $request){

        $em = $this->getDoctrine()->getManager();

        $activite= new Activite();
        $activite->setGroupe($groupe);
        $form = $this->createForm( ActiviteType::class, $activite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($activite);
            $em->flush();
            return $this->redirectToRoute("ActiviteGroupe_list",["id"=>$groupe->getId()]);
        }
        return $this->render('Activité/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/Update/{id}", name="Activite_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository('AppBundle:Activite')->find($id);
        $form = $this->createForm(UpdateActiviteType::class, $activite);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($activite);
            $em->flush();

            return ($this->redirectToRoute("ActiviteGroupe_list",["id"=>$activite->getGroupe()->getId()]));
        }

        return $this->render('Activité/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Activite_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $activite= $em->getRepository('AppBundle:Activite')->find($id);
        $em->remove($activite);
        $em->flush();
        return $this->redirectToRoute("ActiviteGroupe_list");
    }

}
