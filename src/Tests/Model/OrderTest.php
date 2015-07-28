<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model;

use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;

/**
 * OrderTest tests Order entity
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{

    public function assertState($state, Order $order)
    {
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\State\\' . $state, $order->getState());
    }

    public function testInitialState()
    {
        $order = new Order(new Plan([]));
        $this->assertState('Cart', $order);

        return $order;
    }

    /**
     * @depends testInitialState
     */
    public function testAuthenticateTransition(Order $order)
    {
        $order->authenticate($this->getMock('Symfony\Component\Security\Core\User\UserInterface'));
        $this->assertState('Authenticated', $order);

        return $order;
    }

    /**
     * @depends testAuthenticateTransition
     */
    public function testReadyToPayTransition(Order $order)
    {
        $order->readyToPay([]);
        $this->assertState('CanCapture', $order);

        return $order;
    }

    /**
     * @depends testReadyToPayTransition
     */
    public function testDoPaymentTransition(Order $order)
    {
        $order->doPayment();
        $this->assertState('Paid', $order);

        return $order;
    }

    /**
     * @depends testDoPaymentTransition
     */
    public function testDeployTransition(Order $order)
    {
        $order->deploy();
        $this->assertState('StackCreation', $order);

        return $order;
    }

    /**
     * @depends testDeployTransition
     */
    public function testCommitStackTransition(Order $order)
    {
        $order = clone $order;
        $order->commitStack([]);
        $this->assertState('Created', $order);

        return $order;
    }

    /**
     * @depends testDeployTransition
     */
    public function testRollback(Order $order)
    {
        $order->rollbackStack();
        $this->assertState('Rollback', $order);

        return $order;
    }

    /**
     * @depends testRollback
     */
    public function testRelauchDeploy(Order $order)
    {
        $order->deploy();
        $this->assertState('Created', $order);

        return $order;
    }

}
