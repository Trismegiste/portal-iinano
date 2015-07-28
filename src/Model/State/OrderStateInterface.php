<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OrderStateInterface is a contract for a State of a Cart/Order/Invoice
 */
interface OrderStateInterface
{

    public function setAuthenticated(UserInterface $user);
}
