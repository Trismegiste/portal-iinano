<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Created is a state when the deployment is finshed
 */
class Created extends AbstractState
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

    public function setAuthenticated()
    {
        throw new \LogicException();
    }

    public function doPayment()
    {
        $this->context->setState('paid');
    }

    public function failedStack()
    {
        throw new \LogicException('Stack creation was sucessful');
    }

    public function failedPayment()
    {
        // restart payment
        $this->context->setState('authenticated');
    }

}
