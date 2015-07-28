<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\PortalBundle\Model\State\OrderStateInterface;
use Trismegiste\Yuurei\Persistence\Persistable;

/**
 * Order is a customer's order embedding the User and the Product
 */
class Order implements Persistable, OrderOperation
{

    use \Trismegiste\Yuurei\Persistence\PersistableImpl;

    /** @var OrderStateInterface */
    protected $currentState;
    protected $user;

    /** @var Plan */
    protected $product;

    public function __construct(Plan $product)
    {
        $this->product = $product;
        $this->currentState = new State\Cart($this);
    }

    public function getState()
    {
        return $this->currentState;
    }

    /**
     * Do not call - Only State can call this method
     */
    public function setState(OrderStateInterface $newState)
    {
        $this->currentState = $newState;
    }

    /**
     * Action
     *
     * @param UserInterface $user
     */
    public function authenticateWith(UserInterface $user)
    {
        if (is_null($this->user)) {
            $this->user = $user;
            $this->currentState->setAuthenticated();
        } else {
            throw new RuntimeException('Already authenticated');
        }
    }

    public function getUser()
    {
        return $this->user;
    }

}
