<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OrderOperation is a contract for
 */
interface OrderOperation
{

    public function authenticateWith(UserInterface $user);
}
