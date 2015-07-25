<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Rollback is a state when the deployment has failed
 */
class Rollback extends AbstractState
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
        // restart the creation
        $this->context->setState('stackCreation');
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

    public function failedPayment()
    {
        throw new \LogicException();
    }

}
