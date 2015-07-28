<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OrderOperation is a contract for operations affecting an Order
 */
interface OrderOperation
{

    public function authenticateWith(UserInterface $user);

    public function makeItPaid(array $info);
}
