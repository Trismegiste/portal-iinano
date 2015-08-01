<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

use Trismegiste\PortalBundle\Model\Plan;

/**
 * EstimateInquiry is a state wiating for a custom plan
 */
class EstimateInquiry extends AbstractState
{

    public function setProduct(Plan $product)
    {
        $this->executeInContext(function($product) {
            $this->setState(new Cart($this));
            $this->product = $product;
        }, $product);
    }

}
