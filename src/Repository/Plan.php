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

    public function all()
    {
        return [
            new Model\Plan([
                'name' => 'micro',
                'code' => 'sm',
                'dbLimit' => 2,
                'storageLimit' => 2,
                'bandwidthLimit' => 20,
                'price' => 19,
                'recommendedSize' => 100
                    ]),
            new Model\Plan([
                'name' => 'value',
                'code' => 'md',
                'db_limit' => 10,
                'storage_limit' => 20,
                'bandwidth_limit' => 200,
                'price' => 49,
                'recommended_size' => 1000
                    ]),
            new Model\Plan([
                'name' => 'large',
                'code' => 'lg',
                'db_limit' => 50,
                'storage_limit' => 100,
                'bandwidth_limit' => 1000,
                'price' => 199,
                'recommended_size' => 10000
                    ])
        ];
    }

    public function getFloorPrice()
    {
        $listing = $this->all();
        usort($listing, function($a, $b) {
            return $a['price'] < $b['price'] ? -1 : 1;
        });

        return $listing[0]['price'];
    }

}
