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
class Order implements Persistable
{

    use \Trismegiste\Yuurei\Persistence\PersistableImpl;

    /** @var OrderStateInterface */
    protected $currentState;
    protected $stateListing;
    protected $user;
    protected $paypalDetail;

    /** @var Plan */
    protected $product;

    public function __construct(Plan $product)
    {
        $this->product = $product;
        $this->stateListing = [
            'cart' => new State\Cart($this),
            'authenticated' => new State\Authenticated($this),
            'canCapture' => new State\CanCapture($this),
            'stackCreation' => new State\CanCapture($this)
        ];

        $this->currentState = reset($this->stateListing);
    }

    /**
     * Do not call - Only State can call this method
     *
     * @param UserInterface $user
     */
    public function setState($key)
    {
        $this->currentState = $this->stateListing[$key];
    }

    /**
     * Action
     *
     * @param UserInterface $user
     */
    public function authenticate(UserInterface $user)
    {
        if (is_null($this->user)) {
            $this->user = $user;
            $this->currentState->setAuthenticated();
        } else {
            throw new RuntimeException('Already authenticated');
        }
    }

    /**
     * Action
     *
     * @param array $response
     */
    public function readyToPay(array $response)
    {
        $this->currentState->canCapture();
        $this->paypalDetail = $response;
    }

    public function deploy()
    {
        $this->currentState->createStack();
    }

}
