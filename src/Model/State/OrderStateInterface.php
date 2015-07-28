<?php

use Symfony\Component\Security\Core\User\UserInterface;

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * OrderStateInterface is a contract for a State of a Cart/Order/Invoice
 */
interface OrderStateInterface
{

    public function setAuthenticated();
}
