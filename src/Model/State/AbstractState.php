<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Trismegiste\PortalBundle\Model\Order;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AbstractState is an abstract state for an order (the context)
 */
class AbstractState implements OrderStateInterface
{

    /** @var \Trismegiste\PortalBundle\Model\Order */
    protected $context;

    public function __construct(Order $order)
    {
        $this->context = $order;
    }

    protected function executeInContext()
    {
        if (func_num_args() < 1) {
            throw new \InvalidArgumentException('No closure');
        }
        $param = func_get_args();
        $method = array_shift($param);
        $bound = \Closure::bind($method, $this->context, get_class($this->context));
        call_user_func_array($bound, $param);
    }

    public function setAuthenticated(UserInterface $user)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

    public function setPaid(array $info)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

    public function startCreation($stackName)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

    public function setDeployed(array $stackInfo)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

}
