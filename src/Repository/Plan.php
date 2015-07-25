<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Repository;

/**
 * Plan is a repository for Plan
 */
class Plan
{

    public function all()
    {
        return [
            [
                'name' => 'micro',
                'code' => 'sm',
                'db_limit' => 2,
                'storage_limit' => 2,
                'bandwidth_limit' => 20,
                'descr' => 'wesh wesh',
                'price' => 19,
                'recommended_size' => 100
            ],
            [
                'name' => 'value',
                'code' => 'md',
                'db_limit' => 10,
                'storage_limit' => 20,
                'bandwidth_limit' => 200,
                'descr' => 'wesh wesh',
                'price' => 49,
                'recommended_size' => 1000
            ],
            [
                'name' => 'large',
                'code' => 'lg',
                'db_limit' => 50,
                'storage_limit' => 100,
                'bandwidth_limit' => 1000,
                'descr' => 'wesh wesh',
                'price' => 199,
                'recommended_size' => 10000
            ]
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
