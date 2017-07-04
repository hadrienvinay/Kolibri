<?php

namespace Ko\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProjectAffichageController extends Controller
{
    public function listeAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KoProjectBundle:Annonce');
        $annonce = $repository->findAll();

        return $this->render('KoProjectBundle:ProjectAffichage:liste.html.twig', array(
            'annonces' => $annonce,
        ));
    }

}
