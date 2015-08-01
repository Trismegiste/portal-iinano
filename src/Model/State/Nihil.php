<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Trismegiste\PortalBundle\Model\Inquiry;
use Trismegiste\PortalBundle\Model\Plan;

/**
 * Nihil is a starting point for an Order
 */
class Nihil extends AbstractState
{

    public function setProduct(Plan $p)
    {
        $this->executeInContext(function($p) {
            $this->product = $p;
            $this->setState(new Cart($this));
        }, $p);
    }

    public function setEstimate(Inquiry $p)
    {
        $this->executeInContext(function($p) {
            $this->estimate = $p;
            $this->setState(new EstimateInquiry($this));
        }, $p);
    }

}
