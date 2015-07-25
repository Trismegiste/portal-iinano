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
                'name' => 'micro',
                'code' => 'sm',
                'dbLimit' => 2,
                'storageLimit' => 2,
                'bandwidthLimit' => 20,
                'price' => 29,
                'recommendedSize' => 100
                    ]),
            new Model\Plan([
                'name' => 'value',
                'code' => 'md',
                'dbLimit' => 10,
                'storageLimit' => 20,
                'bandwidthLimit' => 200,
                'price' => 99,
                'recommendedSize' => 1000
                    ]),
            new Model\Plan([
                'name' => 'large',
                'code' => 'lg',
                'dbLimit' => 50,
                'storageLimit' => 100,
                'bandwidthLimit' => 1000,
                'price' => 299,
                'recommendedSize' => 10000
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

        $order = new Model\Order($plan);

        return $order;
    }

}
