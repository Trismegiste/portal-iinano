<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trismegiste\PortalBundle\Model\Order;

/**
 * FrontTemplate is a the template controller for Front
 */
class FrontTemplate extends Controller
{

    /**
     * Get current cart
     *
     * @return Order
     */
    protected function getCart()
    {
        return $this->get('session')->get('order');
    }

}
