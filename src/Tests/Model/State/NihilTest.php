<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model\State;

use Trismegiste\PortalBundle\Model\Inquiry;
use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\Plan;
use Trismegiste\PortalBundle\Model\State\Nihil;

/**
 * NihilTest tests the Nihil state
 */
class NihilTest extends StateTestCase
{

    protected function createState(Order $order)
    {
        return new Nihil($order);
    }

    public function test_setEstimate()
    {
        $this->sut->setEstimate(new Inquiry());
        $this->assertState('EstimateInquiry');
    }

    public function test_setProduct()
    {
        $this->sut->setProduct(new Plan([]));
        $this->assertState('Cart');
    }

}
