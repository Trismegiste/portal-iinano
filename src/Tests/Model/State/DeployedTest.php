<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model\State;

use Trismegiste\PortalBundle\Model\Order;
use Trismegiste\PortalBundle\Model\State\Deployed;
use Trismegiste\PortalBundle\Tests\Model\State\StateTestCase;

/**
 * DeployedTest tests the final state Deployed
 *
 * Every changes are invalid so no overriden methods
 */
class DeployedTest extends StateTestCase
{

    protected function createState(Order $order)
    {
        return new Deployed($order);
    }

}
