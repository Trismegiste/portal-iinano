<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\DependencyInjection;

use Trismegiste\OAuthBundle\DependencyInjection\ProviderConfigInterface;

/**
 * OauthConfig is a ...
 */
class OauthConfig implements ProviderConfigInterface
{

    protected $parameter;

    public function __construct($param)
    {
        $this->parameter = $param;
    }

    public function all()
    {
        return $this->parameter;
    }

}
