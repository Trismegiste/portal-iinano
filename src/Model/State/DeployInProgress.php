<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * DeployInProgress is a state when the stack is currently in creation
 */
class DeployInProgress extends AbstractState
{

    public function setDeployed(array $stackInfo)
    {
        $this->executeInContext(function($info) {
            $this->stackOutput = $info;
            $this->currentState = new Deployed($this);
        }, $stackInfo);
    }

}
