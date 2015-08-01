<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Repository;

use Trismegiste\PortalBundle\Repository\Plan;

/**
 * PlanTest tests repository for Plan
 */
class PlanTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;

    protected function setUp()
    {
        $this->sut = new Plan();
    }

    public function testFindBySku()
    {
        $plan = $this->sut->findBySku('sm');
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\Plan', $plan);
    }

    /** @expectedException OutOfRangeException */
    public function testSkuNotFound()
    {
        $plan = $this->sut->findBySku('yolo');
    }

    public function testFloorPrice()
    {
        $this->assertEquals(79, $this->sut->getFloorPrice());
    }

    public function testCreateCart()
    {
        $cart = $this->sut->createCart('sm');
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\Order', $cart);
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\State\Cart', $cart->getState());
    }

}
