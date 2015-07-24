<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle;

use Mother;

/**
 * TrismegistePortalBundle is a ...
 */
class TrismegistePortalBundle extends \Symfony\Component\HttpKernel\Bundle\Bundle
{

    public function getContainerExtension()
    {
        return new DependencyInjection\Extension();
    }

}
