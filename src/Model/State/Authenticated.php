<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use RuntimeException;

/**
 * Authenticated is a state for an Order with a authenticated User
 */
class Authenticated extends AbstractState
{

    public function setAuthenticated()
    {
        throw new RuntimeException('Already authenticated');
    }

    public function canCapture()
    {
        $this->context->setState('canCapture');
    }

    public function createStack()
    {
        throw new RuntimeException('No deployment before payment detail ok');
    }

    public function commitStack()
    {
        throw new \LogicException('No deployment before payment detail ok');
    }

    public function doPayment()
    {
        throw new \LogicException('No payment before payment detail ok');
    }

    public function failedStack()
    {
        throw new \LogicException();
    }

    public function failedPayment()
    {
        throw new \LogicException();
    }

}
