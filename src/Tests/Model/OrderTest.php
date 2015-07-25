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

    protected $sut;

    protected function setUp()
    {
        $this->sut = new Order(new Plan([]));
    }

    protected function assertState($state)
    {
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\State\\' . $state, $this->sut->getState());
    }

    public function testInitialState()
    {
        $this->assertState('Cart');
    }

    public function testAuthenticateTransition()
    {
        $this->sut->authenticate($this->getMock('Symfony\Component\Security\Core\User\UserInterface'));
        $this->assertState('Authenticated');
    }

}
