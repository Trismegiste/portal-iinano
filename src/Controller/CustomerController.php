<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Mother;

/**
 * CustomerController controls actions on Use entity
 */
class CustomerController extends FrontTemplate
{

    public function showAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('My profile');
    }

}
