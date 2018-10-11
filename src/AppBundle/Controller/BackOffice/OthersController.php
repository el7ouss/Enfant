<?php

namespace AppBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Personnel;
use AppBundle\Entity\Actualite;

class OthersController extends Controller
{
    /**
     * @Route("/Home", name="OthersPersonnel")
     */
    public function OtherslistAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personnels= $em->getRepository('AppBundle:Personnel')->findAll();
        $actualites= $em->getRepository('AppBundle:Actualite')->findAll();
        return $this->render('Others/OthersPrincipale.html.twig', ['personnels'=>$personnels, 'actualites'=>$actualites]);




    }
}
