<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Repository;

use Trismegiste\PortalBundle\Repository\User;

/**
 * UserTest tests repository for User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;
    protected $repository;

    protected function setUp()
    {
        $this->repository = $this->getMock('Trismegiste\Yuurei\Persistence\RepositoryInterface');
        $this->sut = new User($this->repository, 'user');
    }

    public function test_findByOauthId()
    {
        $this->repository->expects($this->once())
                ->method('findOne');

        $this->sut->findByOauthId('dummy', 666);
    }

    public function test_findByNickname()
    {
        $this->repository->expects($this->once())
                ->method('findOne');

        $this->sut->findByNickname('baal');
    }

    public function test_findByPk()
    {
        $this->repository->expects($this->once())
                ->method('findByPk');

        $this->sut->findByPk(123);
    }

    public function test_persist()
    {
        $this->repository->expects($this->once())
                ->method('persist');
        $user = $this->sut->create(666, 'dummy', 'baal');
        $this->sut->persist($user);
    }

}
