<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model;

use Trismegiste\PortalBundle\Model\User;

/**
 * UserTest tests User entity
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;

    protected function setUp()
    {
        $this->sut = new User('666', 'dummy', 'baal');
    }

    public function testUsername()
    {
        $this->assertEquals('baal', $this->sut->getUsername());
    }

    public function testOtherProp()
    {
        $this->sut->eraseCredentials();
        $this->sut->getSalt();
        $this->sut->getPassword();
        $this->assertEquals(['ROLE_USER'], $this->sut->getRoles());
    }

}
