<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * OrderController is a controller for step-by-step order processing & fulfillment
 */
class OrderController extends Controller
{

    public function nextStepAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('wesh');
    }

}
