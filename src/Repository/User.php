<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Repository;

use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;
use Trismegiste\PortalBundle\Model\User as MyUser;
use Trismegiste\Yuurei\Persistence\RepositoryInterface;

/**
 * User is a repository for User entity
 */
class User
{

    protected $userClassAlias;
    protected $repository;

    public function __construct(RepositoryInterface $repo, $alias)
    {
        $this->repository = $repo;
        $this->userClassAlias = $alias;
    }

    public function findByOauthId($provider, $uid)
    {
        $found = $this->repository->findOne([
            MapAlias::CLASS_KEY => $this->userClassAlias,
            'uid' => $uid,
            'provider' => $provider
        ]);

        return $found;
    }

    public function findByNickname($username)
    {
        return $this->repository->findOne([
                    MapAlias::CLASS_KEY => $this->userClassAlias,
                    'nickname' => $username
        ]);
    }

    public function findByPk($pk)
    {
        return $this->repository->findByPk($pk);
    }

    public function persist(MyUser $user)
    {
        $this->repository->persist($user);
    }

    public function create($uid, $provider, $nick)
    {
        return new MyUser($uid, $provider, $nick);
    }

}
