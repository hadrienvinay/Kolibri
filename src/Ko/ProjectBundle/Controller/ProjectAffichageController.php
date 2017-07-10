<?php

namespace Ko\ProjectBundle\Controller;

use Ko\ProjectBundle\Entity\Annonce;
use Ko\ProjectBundle\Form\AnnonceType;
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

    public function createAction(Request $request)
    {
        //creation of a new entity with a form
        $postNew = new Annonce();
        //from creation
        $form = $this->get('form.factory')->create(new AnnonceType(), $postNew);

        // si la requete est validée (true si valider)
        if ($form->handleRequest($request)->isValid()) {

            $postNew->setAuthor($this->getUser());
            //on enregistre dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($postNew);
            $em->flush();

            //Message de confirmation du formulaire
            $request->getSession()->getFlashBag()->add('notice', 'Ligne Ajoutée');

            return $this->redirectToRoute('ko_project_liste');
        }

        return $this->render('KoProjectBundle:ProjectAffichage:postForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
