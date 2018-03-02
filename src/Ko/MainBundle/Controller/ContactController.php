<?php

namespace Ko\MainBundle\Controller;

use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ko\MainBundle\Entity\Message;
use Ko\MainBundle\Form\MessageType;
use Ko\MainBundle\Form\ProposalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact/{id}")
     */
    public function contactAction($id,Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('KoMainBundle:Proposal');
        $proposal = $repository->find($id);
        $user = $this->getUser();

        //google maps
        $map = new Map();
        $map->setVariable('map');
        $map->setHtmlId('map_canvas');
        // Disable the auto zoom flag (disabled by default)
        $map->setAutoZoom(true);
        // Sets the center
        $map->setCenter(new Coordinate(0, 0));
        // Sets the zoom
        $map->setMapOption('zoom', 3);

        $geocoder = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDGumVlc4KEBNmAwrso9w5faYMf62JXLBU&address=%s&sensor=false";

        // Get latitude and lonfitude depart and arrival place
        $query = sprintf($geocoder, urlencode(utf8_encode($proposal->getTripId()->getAddressDeparture())));
        dump($query);
        $result = json_decode(file_get_contents($query));
        dump($result);
        $json = $result->results[0];

        $latitudeDepart = (float) $json->geometry->location->lat;
        $longitudeDepart = (float) $json->geometry->location->lng;

        // Requête envoyée à l'API Geocoding
        $query = sprintf($geocoder, urlencode(utf8_encode($proposal->getTripId()->getAddressArrival())));
        dump($query);
        $result = json_decode(file_get_contents($query));
        dump($result);
        $json = $result->results[0];

        $latitudeArrivee = (float) $json->geometry->location->lat;
        $longitudeArrivee= (float) $json->geometry->location->lng;

        $message = new Message();

        $form = $this->get('form.factory')->create(MessageType::class, $message);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $message->setDate(new \DateTime());
            $message->setProposalId($proposal);
            $message->setSenderId($user);


            //create a notification
            //if a driver send a message send notif to the producer
            if ($user->getType() == 1) {
                $userNotified = $proposal->getTripId()->getProducerId()->getUserId();
                $link = 'ko_main_demandes';

            } elseif ($user->getType() == 2) {
                $userNotified = $proposal->getDriverId()->getUserId();
                $link = 'ko_main_trajet';

            }


            $messageNotif = "Nouveau message de" . $user->getFirstName() . ' ' . $user->getFirstName();
            $notifController = $this->get('notification_service');
            $notifController->sendNotificationAction($messageNotif, $link, $userNotified, $em,1);

            $em->persist($message);
            $em->flush();

            $request->getSession()->getFlashBag()->add('warning', 'Profil bien enregistrée.');

            return $this->redirectToRoute('ko_main_contact', array('id' => $id));
        }

        $formDate = $this->get('form.factory')->create(ProposalType::class, $proposal);

        if ($request->isMethod('POST') && $formDate->handleRequest($request)->isValid()) {

            $em->persist($proposal);
            $em->flush();

            //create a notification
            //if a driver send a message send notif to the producer
            if ($user->getType() == 1) {
                $userNotified = $proposal->getTripId()->getProducerId()->getUserId();
                $link = 'ko_main_demandes';

            } elseif ($user->getType() == 2) {
                $userNotified = $proposal->getDriverId()->getUserId();
                $link = 'ko_main_trajet';

            }

            $messageNotif = "Nouveau message de" . $user->getFirstName() . ' ' . $user->getFirstName();
            $notifController = $this->get('notification_service');
            $notifController->sendNotificationAction($messageNotif, $link, $userNotified, $em,1);

            $request->getSession()->getFlashBag()->add('warning', 'Profil bien enregistrée.');

            return $this->redirectToRoute('ko_main_contact',array('id' => $id));
        }


        $repo_proposal = $em->getRepository('KoMainBundle:Proposal');
        $proposal = $repo_proposal->find($id);

        return $this->render('KoMainBundle:Contact:contact.html.twig', array(
            'proposal' => $proposal,
            'form' => $form->createView(),
            'formDate' => $formDate->createView(),
            'user' => $user,
            'map' => $map,
            'latitudeDepart' => $latitudeDepart,
            'longitudeDepart' => $longitudeDepart,
            'latitudeArrivee' => $latitudeArrivee,
            'longitudeArrivee' => $longitudeArrivee,
        ));
    }

}
