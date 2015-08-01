<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model;

use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;

/**
 * OrderWithInquiryTest tests Order entity when a user ask for an estimate
 */
class OrderWithInquiryTest extends \PHPUnit_Framework_TestCase
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
    public function testInquiry(Order $order)
    {
        $order->requestEstimate(new \Trismegiste\PortalBundle\Model\Inquiry());
        $this->assertState('EstimateInquiry', $order);

        return $order;
    }

    /**
     * @depends testInquiry
     */
    public function testAttachProduct(Order $order)
    {
        $order->attachProduct(new Plan([]));
        $this->assertState('Cart', $order);
    }

}
