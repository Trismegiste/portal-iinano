<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use RuntimeException;

/**
 * Cart is a state for an Order in the Cart state
 */
class Cart extends AbstractState
{

    public function setAuthenticated()
    {
        $this->context->setState('authenticated');
    }

    public function canCapture()
    {
        throw new RuntimeException('Unauthenticated');
    }

    public function createStack()
    {
        throw new RuntimeException('Unauthenticated');
    }

}
