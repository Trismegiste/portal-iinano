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
    protected $stackDetail;

    /** @var Plan */
    protected $product;

    public function __construct(Plan $product)
    {
        $this->product = $product;
        $this->stateListing = [
            'cart' => new State\Cart($this),
            'authenticated' => new State\Authenticated($this),
            'canCapture' => new State\CanCapture($this),
            'stackCreation' => new State\CanCapture($this),
            'created' => new State\Created($this),
            'paid' => new State\Paid($this),
            'rollback' => new State\Rollback($this)
        ];

        $this->currentState = reset($this->stateListing);
    }

    public function getState()
    {
        return $this->currentState;
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

    public function getUser()
    {
        return $this->user;
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

    /**
     * Action
     */
    public function deploy()
    {
        $this->currentState->createStack();
    }

    /**
     * Action
     *
     * @param array $response
     */
    public function commitStack(array $response)
    {
        $this->currentState->commitStack();
        $this->stackDetail = $response;
    }

    public function getStackDetail()
    {
        return $this->stackDetail;
    }

    /**
     * Action
     */
    public function rollbackStack()
    {
        $this->currentState->failedStack();
    }

    /**
     * Action
     */
    public function doPayment()
    {
        $this->currentState->doPayment();
    }

    /**
     * Action
     */
    public function paymentHasFailed()
    {
        $this->currentState->failedPayment();
    }

}
