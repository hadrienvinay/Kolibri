<?php

namespace Ko\MainBundle\Controller;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Event\Event;
use Ko\MainBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ko\MainBundle\Entity\Trip;
use Ko\MainBundle\Entity\Proposal;
use Ko\MainBundle\Form\TripType;
use AppBundle\Controller\NotificationController;

use Ivory\GoogleMap\Map;

class AnnonceController extends Controller
{
    /**
     * All annonces page
     * @Route("/annonces")
     */
    public function annoncesAction(Request $request)
    {
        $repoTrips = $this->getDoctrine()->getManager()->getRepository('KoMainBundle:Trip');
        $trips=$repoTrips->findAll();

        $geocoder = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDGumVlc4KEBNmAwrso9w5faYMf62JXLBU&address=%s&sensor=false";

        /*   //google maps
        $map = new Map();
        $map->setVariable('map');
        $map->setHtmlId('map_canvas');
        // Disable the auto zoom flag (disabled by default)
        $map->setAutoZoom(false);
        // Sets the center
        $map->setCenter(new Coordinate(0, 0));

        // Sets the zoom
        $map->setMapOption('zoom', 3);
        */

        $proposals = null;
        $search = null;
        $allPos = null;
        $form   = $this->get('form.factory')->create(SearchType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            //search funtion to calculate the difference between each latitude and longitude of trip and search

            $search = array(
                'addressDeparture' => $form['depart']->getData(),
                'addressArrival' => $form['arrivee']->getData()
            );
            $query = sprintf($geocoder, urlencode(utf8_encode($search['addressDeparture'])));
            $result = json_decode(file_get_contents($query));

            if (empty($result->results)) {
                $latitudeSearchDepart = 0;
                $longitudeSearchDepart = 0;
            } else {
                $json = $result->results[0];
                $latitudeSearchDepart = (float)$json->geometry->location->lat;
                $longitudeSearchDepart = (float)$json->geometry->location->lng;
            }

            $query = sprintf($geocoder, urlencode(utf8_encode($search['addressArrival'])));
            $result = json_decode(file_get_contents($query));

            if (empty($result->results)) {
                $latitudeSearchArrivee = 0;
                $longitudeSearchArrivee = 0;
            } else {
                $json = $result->results[0];
                $latitudeSearchArrivee = (float)$json->geometry->location->lat;
                $longitudeSearchArrivee = (float)$json->geometry->location->lng;
            }


            $alltrips = $repoTrips->findAll();
            $trips = array();
            $j = 0;
            foreach ($alltrips as $trip){

                if((abs($latitudeSearchDepart - $trip->getLatitudeStart()) < 1) && (abs($longitudeSearchDepart - $trip->getLongitudeStart()) <1) && (abs($longitudeSearchArrivee - $trip->getLongitudeEnd()) < 1) && (abs($latitudeSearchArrivee - $trip->getLatitudeEnd()) < 1) )  {
                        $trips[$j] = $trip;
                        $j++;
                    }
            }

        }
        else
            $trips = $repoTrips->findAll();



        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
            if( $user->getType() == 1) {
                $rep_driver = $this->getDoctrine()->getManager()->getRepository('KoMainBundle:Driver');

                $driverId = $user->getDriverId()->getId();

                $repoProposals = $this->getDoctrine()->getManager()->getRepository('KoMainBundle:Proposal');
                $proposals = $repoProposals->findBy(array('driverId' => $driverId));
            }
        }
        else{
            $proposals = null;
        }

        return $this->render('KoMainBundle:Annonce:annonces_liste.html.twig', array(
            'trips' => $trips,
            'search' => $search,
            'listProposals' => $proposals,
            'form' => $form->createView(),
        ));
    }


    /**
     * Mes demandes pages
     * @Route("/producteur/demandes")
     */
    public function demandesAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $repo_proposal = $em->getRepository('KoMainBundle:Proposal');
        $repo_trip = $em->getRepository('KoMainBundle:Trip');
        $repo_prod = $em->getRepository('KoMainBundle:Producer');

        $producerId = $repo_prod->findOneByUserId($user);

        $trips =$repo_trip->findByProducerId($producerId);

        $proposals = array();
        foreach($trips as $trip){
            $proposals[$trip->getId()] = $repo_proposal->findByTripId($trip);
        }
        return $this->render('KoMainBundle:Profil:demandes.html.twig',array(
            'proposals' => $proposals,
            'trips' => $trips
        ));
    }

    /**
     * @Route("/livraison")
     */
    public function livraisonAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $repo_proposal = $em->getRepository('KoMainBundle:Proposal');
        $repo_trip = $em->getRepository('KoMainBundle:Trip');
        $repo_prod = $em->getRepository('KoMainBundle:Producer');

        $producerId = $repo_prod->findOneByUserId($user);

        $trips =$repo_trip->findByProducerId($producerId);

        $proposals = array();
        foreach($trips as $trip) {
            $proposals[$trip->getId()] = $repo_proposal->findBy(['tripId' => $trip->getId()]);
        }

        return $this->render('KoMainBundle:Profil:livraison.html.twig',array(
            'proposals' => $proposals,
            'trips' => $trips
        ));

    }

    /**
     * Add One annnonce by the producteur
     * @Route("/producteur/addAnnonce")
     */
    public function addAnnonceAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $trip = new Trip();
        $form   = $this->get('form.factory')->create(TripType::class, $trip);
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user = $this->getUser();

            $repository = $em->getRepository('KoMainBundle:Producer');
            $productorId = $repository->findOneByUserId($user->getId());
            $trip->setProducerId($productorId);

            $geocoder = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDGumVlc4KEBNmAwrso9w5faYMf62JXLBU&address=%s&sensor=false";

            // Get latitude and lonfitude depart and arrival place
            $query = sprintf($geocoder, urlencode(utf8_encode($trip->getAddressDeparture())));
            $result = json_decode(file_get_contents($query));

            if(empty($result->results)){
                $latitudeDepart = 0;
                $longitudeDepart = 0;
            }
            else {
                $json = $result->results[0];
                $latitudeDepart = (float) $json->geometry->location->lat;
                $longitudeDepart = (float) $json->geometry->location->lng;
                $trip->setLatitudeStart($latitudeDepart);
                $trip->setLongitudeStart($longitudeDepart);
            }

            // Get latitude and lonfitude depart and arrival place
            $query = sprintf($geocoder, urlencode(utf8_encode($trip->getAddressDeparture())));
            $result = json_decode(file_get_contents($query));

            if(empty($result->results)){
                $latitudeArrival = 0;
                $longitudeArrival = 0;
            }
            else {
                $json = $result->results[0];
                $latitudeArrival = (float) $json->geometry->location->lat;
                $longitudeArrival = (float) $json->geometry->location->lng;
                $trip->setLatitudeEnd($latitudeArrival);
                $trip->setLongitudeEnd($longitudeArrival);
            }

            $em->persist($trip);
            $em->flush();

            $request->getSession()->getFlashBag()->add('warning', 'Annonce bien enregistrée.');

            $user = $this->getUser();
            return $this->render('KoMainBundle:Profil:profil.html.twig', array(
                'user' => $user,
            ));
        }

        return $this->render('KoMainBundle:Annonce:addAnnonce.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));

    }


    /**
     * @Route("/producteur/editAnnonce/{id}")
     */
    public function editAnnonceAction(Request $request,$id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('KoMainBundle:Trip');
        $trip = $repository->find($id);
        $form = $this->get('form.factory')->create(TripType::class, $trip);
        $user = $this->getUser();

        if(!$trip){
            throw $this->createNotFoundException("Cette annonce n'existe pas ! " );
        }

        if($user != $trip->getProducerId()->getUserId()){
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $em->persist($trip);
            $em->flush();

            $request->getSession()->getFlashBag()->add('warning', 'Annonce bien modifiée.');

            $user = $this->getUser();
            return $this->render('KoMainBundle:Profil:profil.html.twig', array(
                'user' => $user,
            ));
        }

        return $this->render('KoMainBundle:Annonce:editAnnonce.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));

    }

    /**
     * Detail with a map for an annonce
     * @Route("/annonce/{id}")
     */
    public function detailAnnonceAction($id)
    {
        //if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {throw $this->createAccessDeniedException();}

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('KoMainBundle:Trip');
        $trip = $repository->find($id);

        if(!$trip){
            throw $this->createNotFoundException("Cette annonce n'existe pas ! " );
        }

        $geocoder = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDGumVlc4KEBNmAwrso9w5faYMf62JXLBU&address=%s&sensor=false";

        // Get latitude and lonfitude depart and arrival place
        $query = sprintf($geocoder, urlencode(utf8_encode($trip->getAddressDeparture())));
        $result = json_decode(file_get_contents($query));
        dump($query);
        dump($result);
        if(empty($result->results)){
            $latitudeDepart = 0;
            $longitudeDepart = 0;
        }
        else {
            $json = $result->results[0];
            $latitudeDepart = (float) $json->geometry->location->lat;
            $longitudeDepart = (float) $json->geometry->location->lng;
        }


        // Requête envoyée à l'API Geocoding
        $query = sprintf($geocoder, urlencode(utf8_encode($trip->getAddressArrival())));
        $result = json_decode(file_get_contents($query));
        dump($query);
        dump($result);
        if(empty($result->results)){
            $latitudeArrivee = 0;
            $longitudeArrivee = 0;
        }
        else {
            $json = $result->results[0];
            $latitudeArrivee = (float)$json->geometry->location->lat;
            $longitudeArrivee = (float)$json->geometry->location->lng;
        }

        return $this->render('KoMainBundle:Annonce:detailAnnonce.html.twig', array(
            'trip' => $trip,
            'latitudeDepart' => $latitudeDepart,
            'longitudeDepart' =>$longitudeDepart,
            'latitudeArrivee' => $latitudeArrivee,
            'longitudeArrivee' =>$longitudeArrivee,
        ));

    }


    /**
     * @Route("/producteur/deleteAnnonce/{id}")
     */
    public function deleteAnnonceAction($id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $repository = $em->getRepository('KoMainBundle:Trip');
        $trip = $repository->find($id);
        if (!$trip) {
            throw $this->createNotFoundException('Aucune annonce trouvée pour id: '.$id);
        }
        if($user != $trip->getProducerId()->getUserId()){
            throw $this->createAccessDeniedException();
        }
        $em->remove($trip);
        $em->flush();


        // DELETE NOTIFICATION //

        return $this->render('KoMainBundle:Profil:profil.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Driver confirm a trip
     * @Route("/apply/id")
     */
    public function applyAction($id)
    {
        $proposal = new Proposal();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $rep_driver = $em->getRepository('KoMainBundle:Driver');
        $driverId = $rep_driver->findOneByUserId($user->getId());
        $proposal->setDriverId($driverId);
        $proposal->setDate(new \DateTime());

        $rep_trip = $em->getRepository('KoMainBundle:Trip');
        $current_trip = $rep_trip->find($id);
        $proposal->setTripId($current_trip);

        //$proposal->setProducerId($current_trip->getProducerId());
        $proposal->setAccepted(0);


        //create a notification
        $message = "Vous avez recu une proposition pour votre annonce".$proposal->getTripId()->getTypeProduct();
        $link = 'ko_main_demandes';
        $userNotified = $proposal->getTripId()->getProducerId()->getUserId();
        $notifController = $this->get('notification_service');
        $type = 0;
        $notifController->sendNotificationAction($message,$link,$userNotified,$em,$type);

        $em->persist($proposal);
        $em->flush();


        return $this->detailAnnonceAction($current_trip->getId());

    }

    /**
     * Driver cancel his confirmation for a trip
     * @Route("/delete/{id}")
     */
    public function deleteAction($id) {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $proposal = $em->getRepository('KoMainBundle:Proposal')->findOneBy(array("tripId" => $id,"driverId" => $user->getDriverId()));


        //Update the deletion of a notification
        $notifController = $this->get('notification_service');
        $repo_notif = $em->getRepository('AppBundle:Notification');
        $notification = $repo_notif->findOneBy(array("type" => 0,"userId" => $proposal->getTripId()->getProducerId()->getUserId()));
       // $notifController->deleteNotificationAction($notification,$em); //

        $em->remove($proposal);
        $em->flush();

        return $this->annoncesAction();
    }


    /*
     * The productor valid a trip confirmed by a driver
     *
     */
    public function validProposalAction($id){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('KoMainBundle:Proposal');
        $proposal = $repository->find($id);

        //create a notification
        $message = "Vous proposition à été validée".$proposal->getTripId()->getTypeProduct();
        $link = 'ko_main_trajet';
        $userNotified = $proposal->getTripId()->getProducerId()->getUserId();
        $notifController = $this->get('notification_service');
        $type = 1;
        $notifController->sendNotificationAction($message,$link,$userNotified,$em,$type);

        $proposal->setAccepted(1);
        $em->persist($proposal);
        $em->flush();

        return $this->redirectToRoute('ko_main_demandes');

    }
}
