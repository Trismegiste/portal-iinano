<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Authenticated is a state for an Order with a authenticated User
 */
class Authenticated extends AbstractState
{

    public function setTransactionInfo(array $info)
    {
        $bound = \Closure::bind(function($info) {
                    if (is_null($this->transactionInfo)) {
                        $this->currentState = new Paid($this);
                        $this->transactionInfo = $info;
                    } else {
                        throw new InvalidTransitionException('Already paid');
                    }
                }, $this->context, get_class($this->context));

        call_user_func($bound, $info);
    }

}
