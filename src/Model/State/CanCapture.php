<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * CanCapture is a state when an Order can be paid
 */
class CanCapture extends AbstractState
{

    public function canCapture()
    {
        throw new \LogicException('Payment detail already set');
    }

    public function createStack()
    {
        $this->context->setState('stackCreation');
    }

    public function setAuthenticated()
    {
        throw new \LogicException('Already authenticated');
    }

    public function commitStack()
    {
        throw new \LogicException('Stack creation was not launched');
    }

    public function doPayment()
    {
        throw new \LogicException('Stack creation is not launched');
    }

    public function failedStack()
    {
        throw new \LogicException();
    }

}
