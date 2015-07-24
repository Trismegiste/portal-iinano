<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * FrontController is a ...
 */
class FrontController extends Controller
{

    public function indexAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('ok');
    }

}
