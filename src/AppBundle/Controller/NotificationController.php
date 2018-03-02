<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Notification;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class NotificationController extends Controller
{

    public function sendNotificationAction($message, $link, User $user, $em, $type)
    {
        //add a notification
        $notification = new Notification();
        $notification->setDate(new \DateTime());
        $notification->setMessage($message);
        $notification->setLink($link);
        $notification->setSeen(false);
        $notification->setUserId($user);
        $notification->setType($type);

        //persit into bdd
        $em->persist($notification);
        $em->flush();

        return new JsonResponse(200);

    }

    /*
     *
     */
    public function seenNotificationAction(Notification $notification)
    {
        if (!$notification) {
            throw $this->createNotFoundException('Aucune annonce trouvée pour id: '. $notification->getId());
        }

        $notification->setSeen(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();

        return new JsonResponse(200);
    }

    public function deleteNotificationAction(Notification $notification,$em)
    {
        if (!$notification) {
            throw $this->createNotFoundException('Aucune annonce trouvée pour id: '. $notification->getId());
        }

        $em->remove($notification);
        $em->flush();

        return new JsonResponse(200);
    }
}
