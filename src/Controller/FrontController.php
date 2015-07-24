<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * FrontController is a controller for the front (demo, landing page...)
 */
class FrontController extends Controller
{

    public function indexAction()
    {
        return $this->render('TrismegistePortalBundle:Front:index.html.twig');
    }

    public function connectAction()
    {
        return $this->render('TrismegistePortalBundle:Front:connect.html.twig');
    }

}
