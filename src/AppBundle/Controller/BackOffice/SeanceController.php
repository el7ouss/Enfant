<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Seance;
use AppBundle\Form\SeanceType;
use AppBundle\Form\UpdateSeanceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Seance")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class SeanceController extends Controller
{
    /**
     * @Route("/List", name="Seance_list")
     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $seance = $em->getRepository('AppBundle:Seance')->findAll();

        return $this->render('Seance/List.html.twig', ['seance' => $seance]);
    }

    /**
     * @Route("/{id}/List", name="SeanceActivite_list")
     */
    public function ListSeanceAction(Activite $activite)
    {
        $em = $this->getDoctrine()->getManager();
        $seance = $em->getRepository('AppBundle:Seance')->findBy(["activite" => $activite], ["id" => "desc"]);

        return $this->render('Seance/List.html.twig', ['seance' => $seance,"activite"=>$activite]);
    }

    /**
     * @Route("/{id}/Add", name="Seance_Add")
     */
    public function addAction(Activite $activite, Request $request){

        $em = $this->getDoctrine()->getManager();


        $seance= new Seance();
        $seance->setActivite($activite);
        $form = $this->createForm( SeanceType::class, $seance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($seance);
            $em->flush();
            return $this->redirectToRoute("SeanceActivite_list",["id"=>$activite->getId()]);
        }
        return $this->render('Seance/Add.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/Update/{id}", name="Seance_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $seance = $em->getRepository('AppBundle:Seance')->find($id);
        $form = $this->createForm(UpdateSeanceType::class, $seance);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($seance);
            $em->flush();

            return ($this->redirectToRoute("SeanceActivite_list",["id"=>$seance->getActivite()->getId()]));
        }

        return $this->render('Seance/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Seance_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $seance= $em->getRepository('AppBundle:Seance')->find($id);
        $em->remove($seance);
        $em->flush();
        return $this->redirectToRoute("SeanceActivite_list");
    }

}
