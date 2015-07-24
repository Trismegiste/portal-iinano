<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\OAuthBundle\Security\OauthUserProviderInterface;

/**
 * UserProvider is a ...
 */
class UserProvider implements OauthUserProviderInterface
{

    public function __construct()
    {

    }

    public function loadUserByUsername($username)
    {

    }

    public function refreshUser(UserInterface $user)
    {

    }

    public function supportsClass($class)
    {

    }

    public function findByOauthId($provider, $uid)
    {

    }

}
