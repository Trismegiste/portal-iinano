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

    /** @var UserInterface */
    protected $user;

    /** @var Plan */
    protected $product;

    /** @var array */
    protected $transactionInfo;

    /** @var string */
    protected $stackName;

    /** @var array */
    protected $createStackOutput;

    public function __construct(Plan $product)
    {
        $this->product = $product;
        $this->currentState = new State\Cart($this);
    }

    /**
     * @inheritdoc
     */
    public function authenticateWith(UserInterface $user)
    {
        $this->currentState->setAuthenticated($user);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getState()
    {
        return $this->currentState;
    }

    public function makeItPaid(array $info)
    {
        $this->currentState->setPaid($info);
    }

    public function createStack($stackName)
    {
        $this->currentState->startCreation($stackName);
    }

}
