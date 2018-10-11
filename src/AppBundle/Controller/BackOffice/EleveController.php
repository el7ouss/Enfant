<?php

namespace AppBundle\Controller\BackOffice;

use AppBundle\Entity\Eleve;
use AppBundle\Entity\Groupe;
use AppBundle\Form\EleveType;
use AppBundle\Form\UpdateEleveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("Eleve")
 * @Security("has_role('ROLE_RESPONSABLE')")
 */
class EleveController extends Controller
{
    /**
     * @Route("/List", name="Eleve_list")

     */
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eleve = $em->getRepository('AppBundle:Eleve')->findAll();
        return $this->render('Eleve/List.html.twig', array('eleve' => $eleve));
    }
    /**
     * @Route("/{id}/List", name="EleveGroupe_list")
     */
    public function ListSalaireAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository('AppBundle:Eleve')->findBy(["groupe" => $groupe], ["id" => "desc"]);

        return $this->render('Eleve/List.html.twig', ['groupe' => $groupe, "eleve"=>$eleve]);
    }

    /**
     * @Route("/Add", name="Eleve_Add")
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $eleve= new Eleve();
        $form = $this->createForm( EleveType::class, $eleve);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $eleve->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('Eleve_directory'),
                $fileName);
            $eleve->setImage($fileName);
            $em->persist($eleve);
            $em->flush();
            return $this->redirectToRoute("Eleve_list");
        }
        return $this->render('Eleve/Add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/Update/{id}", name="Eleve_Update")
     */
    public function updateAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository('AppBundle:Eleve')->find($id);
        $eleveImage = $eleve->getImage();

        $form = $this->createForm(UpdateEleveType::class, $eleve);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $eleve->getImage();
            if ($file!= null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('Eleve_directory'),
                    $fileName);
                $eleve->setImage($fileName);
            }else{
                $eleve->setImage($eleveImage);
            }
            $em->persist($eleve);
            $em->flush();

            return ($this->redirectToRoute("Eleve_list"));
        }

        return $this->render('Eleve/Update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/Delete/{id}", name="Eleve_Delete")
     */
    public function deleteAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $eleve= $em->getRepository('AppBundle:Eleve')->find($id);
        $em->remove($eleve);
        $em->flush();
        return $this->redirectToRoute("Eleve_list");
    }

}
