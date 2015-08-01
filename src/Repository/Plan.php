<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Repository;

use Trismegiste\PortalBundle\Model;

/**
 * Plan is a repository for Plan
 */
class Plan
{

    /**
     * Get all plans
     *
     * @return Model\Plan[]
     */
    public function all()
    {
        return [
            new Model\Plan([
                'name' => 'starter',
                'code' => 'sm',
                'dbLimit' => 2,
                'storageLimit' => 10,
                'bandwidthLimit' => 300,
                'price' => 79,
                'recommendedSize' => 100
                    ]),
            new Model\Plan([
                'name' => 'value',
                'code' => 'value',
                'dbLimit' => 10,
                'storageLimit' => 30,
                'bandwidthLimit' => 1000,
                'price' => 149,
                'recommendedSize' => 1000
                    ])
        ];
    }

    public function getFloorPrice()
    {
        $listing = $this->all();
        usort($listing, function(Model\Plan $a, Model\Plan $b) {
            return $a->getPrice() < $b->getPrice() ? -1 : 1;
        });

        return $listing[0]->getPrice();
    }

    public function findBySku($sku)
    {
        foreach ($this->all() as $plan) {
            if ($plan->getCode() === $sku) {
                return $plan;
            }
        }

        throw new \OutOfRangeException("$sku not found");
    }

    public function createCart($sku)
    {
        $plan = $this->findBySku($sku);

        $order = new Model\Order();
        $order->attachProduct($plan);

        return $order;
    }

}
