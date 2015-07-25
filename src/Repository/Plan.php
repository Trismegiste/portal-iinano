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
                'descr' => 'wesh wesh'
            ]
        ];
    }

}
