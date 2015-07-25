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
                'db_limit' => 2,
                'storage_limit' => 2,
                'bandwidth_limit' => 20,
                'descr' => 'wesh wesh',
                'price' => 19
            ],
            [
                'name' => 'value',
                'db_limit' => 10,
                'storage_limit' => 20,
                'bandwidth_limit' => 300,
                'descr' => 'wesh wesh',
                'price' => 49
            ],
            [
                'name' => 'large',
                'db_limit' => 50,
                'storage_limit' => 100,
                'bandwidth_limit' => 1000,
                'descr' => 'wesh wesh',
                'price' => 199
            ]
        ];
    }

}
