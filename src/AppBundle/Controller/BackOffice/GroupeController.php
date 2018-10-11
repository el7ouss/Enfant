<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Eleve;
use AppBundle\Entity\Groupe;
use AppBundle\Form\GroupeType;
use AppBundle\Form\UpdateGroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Groupe")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class GroupeController extends Controller
{
    /**
     * @Route("/List", name="Groupe_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository('AppBundle:Groupe')->findAll();
        return $this->render('Groupe/List.html.twig', array('groupe' => $groupe));
    }

    /**
     * @Route("/{id}/List", name="GroupeEleve_list")
     */
    public function ListGroupeAction(Eleve $eleve)
    {
        $em = $this->getDoctrine()->getManager();
        $groupe = $em->getRepository('AppBundle:Groupe')->findBy(["eleve" => $eleve], ["id" => "desc"]);

        return $this->render('Groupe/List.html.twig', ['groupe' => $groupe,"eleve"=>$eleve]);
    }

    /**
     * @Route("/Add", name="Groupe_Add")
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $groupe= new Groupe();
        $form = $this->createForm( GroupeType::class, $groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($groupe);
            $em->flush();
            return $this->redirectToRoute("Groupe_list");
        }
        return $this->render('Groupe/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/Update/{id}", name="Groupe_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $groupe = $em->getRepository('AppBundle:Groupe')->find($id);

        $form = $this->createForm(UpdateGroupeType::class, $groupe);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($groupe);
            $em->flush();

            return ($this->redirectToRoute("Groupe_list"));
        }

        return $this->render('Groupe/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Groupe_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $groupe= $em->getRepository('AppBundle:Groupe')->find($id);
        $em->remove($groupe);
        $em->flush();
        return $this->redirectToRoute("Groupe_list");
    }

}