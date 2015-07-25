<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\Yuurei\Persistence\Persistable;

/**
 * User is a ...
 */
class User implements UserInterface, Persistable
{

    use \Trismegiste\Yuurei\Persistence\PersistableImpl;

    public $nickname;
    public $provider;
    public $uid;

    public function eraseCredentials()
    {

    }

    public function getPassword()
    {

    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {

    }

    public function getUsername()
    {
        return $this->nickname;
    }

}
