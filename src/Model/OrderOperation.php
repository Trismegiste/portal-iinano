<?php

use Symfony\Component\Security\Core\User\UserInterface;

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

/**
 * OrderOperation is a contract for
 */
interface OrderOperation
{

    public function authenticateWith(UserInterface $user);
}
