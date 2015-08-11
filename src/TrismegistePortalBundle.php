<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trismegiste\PortalBundle\DependencyInjection\Extension;

/**
 * TrismegistePortalBundle is the bundle for iinano portal
 */
class TrismegistePortalBundle extends Bundle
{

    public function getContainerExtension()
    {
        if (is_null($this->extension)) {
            $this->extension = new Extension();
        }

        return $this->extension;
    }

}
