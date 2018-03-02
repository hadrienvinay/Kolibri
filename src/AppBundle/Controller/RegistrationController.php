<?php
/**
 * Created by PhpStorm.
 * User: hadrien
 * Date: 11/01/2018
 * Time: 16:45
 */

// src/AppBundle/Controller/RegistrationController.php

namespace AppBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Ko\MainBundle\Entity\Driver;
use Ko\MainBundle\Entity\Producer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function registerAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                $em = $this->getDoctrine()->getManager();

                //set default picture
                $user->setPicture('profil_pic.png');
                // update link with producer or driver
                if($user->getType()==1){
                    $user->setRoles(array('ROLE_USER'));
                    $driver = new Driver();
                    $driver->setUserId($user);
                    $em->persist($driver);
                }

                if($user->getType()==2){
                    $user->setRoles(array('ROLE_PRODUCER'));
                    $producer = new Producer();
                    $producer->setUserId($user);
                    $em->persist($producer);
                }

                //save in bdd
                $em->flush();

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);




            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('@FOSUser/Registration/register.html.twig', array('form' => $form->createView(),));
    }

}