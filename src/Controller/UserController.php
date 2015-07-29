<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Mother;

/**
 * UserController controls actions on Use entity
 */
class UserController extends FrontTemplate
{

    public function showAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('My profile');
    }

}
