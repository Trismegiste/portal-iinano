<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;
use Trismegiste\OAuthBundle\Security\OauthUserProviderInterface;
use Trismegiste\Yuurei\Persistence\RepositoryInterface;

/**
 * UserProvider is a ...
 */
class UserProvider implements OauthUserProviderInterface, UserProviderInterface
{

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repository = $repo;
        $this->userClassAlias = 'user';
    }

    public function loadUserByUsername($username)
    {
        $found = $this->repository->findOne([
            MapAlias::CLASS_KEY => $this->userClassAlias,
            'nickname' => $username
        ]);

        if (is_null($found)) {
            throw new UsernameNotFoundException("We don't know $username");
        }

        return $found;
    }

    public function refreshUser(UserInterface $user)
    {
        if ($this->supportsClass(get_class($user))) {
            return $this->repository->findByPk((string) $user->getId());
        } else {
            throw new UnsupportedUserException("Don't know to manage a " . get_class($user));
        }
    }

    public function supportsClass($class)
    {
        return $class === 'Trismegiste\PortalBundle\Model\User';
    }

    public function findByOauthId($provider, $uid)
    {
        $found = $this->repository->findOne([
            MapAlias::CLASS_KEY => $this->userClassAlias,
            'uid' => $uid,
            'provider' => $provider
        ]);

        if (is_null($found)) {
            throw new UsernameNotFoundException("We don't know [$provider, $uid]");
        }

        return $found;
    }

}
