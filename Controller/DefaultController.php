<?php

namespace NotificationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NotificationsBundle:Default:index.html.twig');
    }
}
