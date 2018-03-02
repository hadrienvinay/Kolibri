<?php

namespace Ko\MainBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\MimeType;

class ProfilController extends Controller
{
    /**
     * @Route("/profil/{id}")
     */
    public function profilAction($id)
    {
        $repo_user = $this->getDoctrine()->getManager()->getRepository('AppBundle:User');
        $user = $repo_user->find($id);
        return $this->render('KoMainBundle:Profil:profil.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route ("/profiledit/{id}")
     */
    public function profileditAction($id, Request $request)
    {
        //check if user is connected
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        // check if user == user logged in
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:User');
        $user = $repository->find($id);

        if($user != $this->getUser()){
            throw $this->createAccessDeniedException();
        }

        $actualPicture = $user->getPicture();
        $form   = $this->get('form.factory')->create(UserType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $user->getPicture();
            if($image == null) {
                $user->setPicture($actualPicture);
            }
            else {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move($this->getParameter('profil_picture_directory'), $imageName);
                $user->setPicture($imageName);
            }
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('warning', 'Profil bien enregistrée.');

            return $this->redirectToRoute('ko_main_profil', array('id' => $user->getId()));
        }

        return $this->render('KoMainBundle:Profil:editProfil.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));
    }
}
