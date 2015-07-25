<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Paid is a state when the Order has been paid
 */
class Paid extends AbstractState
{

    public function canCapture()
    {
        throw new \LogicException();
    }

    public function commitStack()
    {
        throw new \LogicException();
    }

    public function createStack()
    {
        throw new \LogicException();
    }

    public function doPayment()
    {
        throw new \LogicException();
    }

    public function failedStack()
    {
        throw new \LogicException();
    }

    public function setAuthenticated()
    {
        throw new \LogicException();
    }

}
