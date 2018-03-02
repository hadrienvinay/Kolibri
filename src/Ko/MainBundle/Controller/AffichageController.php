<?php

namespace Ko\MainBundle\Controller;


use Ko\MainBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AffichageController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction(Request $request)
    {
        $form   = $this->get('form.factory')->create(SearchType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            return $this->redirectToRoute('ko_main_annonces');
        }
        return $this->render('KoMainBundle:Main:accueil.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/admin")
     */
    public function adminAction(){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
        $allUsers= $repository->findAll();


        return $this->render('KoMainBundle:Main:admin.html.twig', array(
            'users' => $allUsers,
        ));

    }

}
