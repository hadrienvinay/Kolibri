<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace Ko\ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProjectController extends Controller
{

    public function accueilAction()
    {
        return $this->render('KoProjectBundle:Home:indexView.html.twig');
    }
}