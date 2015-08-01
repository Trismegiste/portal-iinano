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
            $this->executeInContext(function($user) {
                $this->setState(new Authenticated($this));
                $this->user = $user;
            }, $user);
        } else {
            throw new InvalidTransitionException("Already authenticated");
        }
    }

}
