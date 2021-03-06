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
            $this->setState(new Deployed($this));
        }, $stackInfo);
    }

    public function rollbacked()
    {
        $this->executeInContext(function() {
            $this->setState(new Paid($this));
        });
    }

}
