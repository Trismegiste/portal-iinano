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
        throw new \LogicException('Stack creation is launched after payment');
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
        $this->context->setState('paid');
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
