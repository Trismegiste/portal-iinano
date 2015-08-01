<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model;

use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;

/**
 * OrderWithPlanTest tests Order entity when a user choose a Plan
 */
class OrderWithPlanTest extends \PHPUnit_Framework_TestCase
{

    public function assertState($state, Order $order)
    {
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\State\\' . $state, $order->getState());
    }

    public function testInitialState()
    {
        $order = new Order();
        $this->assertState('Nihil', $order);

        return $order;
    }

    /**
     * @depends testInitialState
     */
    public function testAttachProduct(Order $order)
    {
        $order->attachProduct(new Plan([]));
        $this->assertState('Cart', $order);

        return $order;
    }

    /**
     * @depends testAttachProduct
     */
    public function testAuthenticateTransition(Order $order)
    {
        $user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $order->authenticateWith($user);
        $this->assertState('Authenticated', $order);
        $this->assertNotNull($order->getUser());

        return $order;
    }

    /**
     * @depends testAuthenticateTransition
     */
    public function testMakePaymentTransition(Order $order)
    {
        $order->makeItPaid([]);
        $this->assertState('Paid', $order);

        return $order;
    }

    /**
     * @depends testMakePaymentTransition
     */
    public function testStartCreation(Order $order)
    {
        $order->createStack('dummy');
        $this->assertState('DeployInProgress', $order);
        $this->assertEquals('dummy', $order->getStackName());

        return $order;
    }

    /**
     * @depends testStartCreation
     */
    public function testDeploymentOk(Order $order)
    {
        $order->deploymentOk([]);
        $this->assertState('Deployed', $order);

        return $order;
    }

    public function testDeployHasFailed()
    {
        $order = new Order();
        $order->attachProduct(new Plan([]));
        $user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $order->authenticateWith($user);
        $order->makeItPaid([]);
        $order->createStack('dummy');
        $this->assertState('DeployInProgress', $order);

        $order->deploymentFailed();
        $this->assertState('Paid', $order);
    }

}
