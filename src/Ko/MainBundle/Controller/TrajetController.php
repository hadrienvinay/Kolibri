<?php

namespace Ko\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/*
 * Controller for the driver : his trips and validation with the producer
 *
 */
class TrajetController extends Controller
{
    /**
     * @Route("/trajet")
     */
    public function trajetAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $driver = $user->getDriverId();
        $repo_proposal = $em->getRepository('KoMainBundle:Proposal');

        $proposals = $repo_proposal->findByDriverId($driver);

        return $this->render('@KoMain/Trajet/trajet.html.twig', array(
            'proposals' => $proposals,
        ));
    }

}
