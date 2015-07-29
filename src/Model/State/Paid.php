<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * Paid is a ...
 */
class Paid extends AbstractState
{

    public function startCreation($stackName)
    {
        $this->executeInContext(function($str) {
            $this->stackName = $str;
            $this->currentState = new DeployInProgress($this);
        }, $stackName);
    }

}
