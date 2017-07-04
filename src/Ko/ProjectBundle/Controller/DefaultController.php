<?php

namespace Ko\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KoProjectBundle:Default:index.html.twig');
    }
}
