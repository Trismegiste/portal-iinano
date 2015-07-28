<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Cart is a state for an Order in the Cart state
 */
class Cart extends AbstractState
{

    public function setAuthenticated(UserInterface $user)
    {
        if (is_null($this->context->getUser())) {
            $bound = \Closure::bind(function($user) {
                        $this->currentState = new Authenticated($this);
                        $this->user = $user;
                    }, $this->context, get_class($this->context));
            call_user_func($bound, $user);
        } else {
            throw new InvalidTransitionException("Already authenticated");
        }
    }

}
