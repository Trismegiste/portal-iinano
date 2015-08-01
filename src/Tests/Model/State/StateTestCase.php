<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model\State;

use Trismegiste\PortalBundle\Model\Inquiry;
use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;
use Trismegiste\PortalBundle\Model\State\OrderStateInterface;

/**
 * StateTestCase is a test template for State
 */
abstract class StateTestCase extends \PHPUnit_Framework_TestCase
{

    /** @var OrderStateInterface */
    protected $sut;

    /** @var Order */
    protected $order;

    protected function setUp()
    {
        $this->order = new Order();
        $this->sut = $this->createState($this->order);
    }

    abstract protected function createState(Order $order);

    protected function assertState($state)
    {
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\State\\' . $state, $this->order->getState());
    }

    public function test_rollbacked()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->rollbacked();
    }

    public function test_setAuthenticated()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $this->sut->setAuthenticated($user);
    }

    public function test_setDeployed()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->setDeployed([]);
    }

    public function test_setEstimate()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->setEstimate(new Inquiry());
    }

    public function test_setPaid()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->setPaid([]);
    }

    public function test_setProduct()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->setProduct(new Plan([]));
    }

    public function test_startCreation()
    {
        $this->setExpectedException('Trismegiste\PortalBundle\Model\State\InvalidTransitionException');
        $this->sut->startCreation('fgssgh');
    }

}
