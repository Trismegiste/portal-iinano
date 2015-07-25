<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * StackCreation is a state when the deployment is in progress
 */
class StackCreation extends AbstractState
{

    public function canCapture()
    {
        throw new \LogicException('Payment detail already set');
    }

    public function createStack()
    {
        throw new \LogicException('Creation in progress');
    }

    public function setAuthenticated()
    {
        throw new \LogicException('Creation in progress');
    }

    public function commitStack()
    {
        $this->context->setState('created');
    }

    public function doPayment()
    {
        throw new \LogicException('Stack creation already paid');
    }

    public function failedStack()
    {
        $this->context->setState('rollback');
    }

    public function failedPayment()
    {
        throw new \LogicException();
    }

}
