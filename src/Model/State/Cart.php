<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Cart is a state for an Order in the Cart state
 */
class Cart extends AbstractState
{

    public function setAuthenticated()
    {
        $this->context->setState(new Authenticated($this->context));
    }

}
