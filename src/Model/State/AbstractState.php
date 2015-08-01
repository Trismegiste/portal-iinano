<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\PortalBundle\Model\Inquiry;
use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;

/**
 * AbstractState is an abstract state for an order (the context)
 */
class AbstractState implements OrderStateInterface
{

    /** @var Order */
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
        // check parameters count :
        $refl = new \ReflectionFunction($method);
        if ($refl->getNumberOfParameters() !== count($param)) {
            throw new \InvalidArgumentException('Parameters count in closure does not match arguments count');
        }

        $bound = \Closure::bind($method, $this->context, $this->context);

        call_user_func_array($bound, $param);
    }

    public function setAuthenticated(UserInterface $user)
    {
        throw new InvalidTransitionException(__METHOD__ . ' on ' . get_called_class());
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

    public function rollbacked()
    {
        throw new InvalidTransitionException(__METHOD__);
    }

    public function setEstimate(Inquiry $estim)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

    public function setProduct(Plan $product)
    {
        throw new InvalidTransitionException(__METHOD__);
    }

}
