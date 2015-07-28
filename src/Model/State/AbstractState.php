<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Trismegiste\PortalBundle\Model\Order;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AbstractState is an abstract state for an order (the context)
 */
class AbstractState implements OrderStateInterface
{

    /** @var \Trismegiste\PortalBundle\Model\Order */
    protected $context;

    public function __construct(Order $order)
    {
        $this->context = $order;
    }

    public function setAuthenticated(UserInterface $user)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

}
