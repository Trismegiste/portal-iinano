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

    public function setPaid(array $info);

    public function startCreation($stackName);

    public function setDeployed(array $stackInfo);
}
