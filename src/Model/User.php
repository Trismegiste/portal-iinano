<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Trismegiste\Yuurei\Persistence\Persistable;

/**
 * User is a Customer
 */
class User implements UserInterface, Persistable
{

    use \Trismegiste\Yuurei\Persistence\PersistableImpl;

    protected $nickname;
    protected $provider;
    protected $uid;

    public function __construct($uid, $provider, $nick)
    {
        $this->nickname = $nick;
        $this->provider = $provider;
        $this->uid = $uid;
    }

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
