<?php

namespace Ko\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProducteurController extends Controller
{
    /**
     * @Route("/producteurs")
     */
    public function producteursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo_prod = $em->getRepository('KoMainBundle:Producer');
        $producers = $repo_prod->findAll();

        return $this->render('KoMainBundle:Producteur:producerList.html.twig',array(
            'producers' => $producers,
        ));
    }
}
