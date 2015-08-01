<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Model;

use Trismegiste\PortalBundle\Model\Plan;

/**
 * PlanTest tests Plan entity
 */
class PlanTest extends \PHPUnit_Framework_TestCase
{

    /** @var Plan */
    protected $sut;

    protected function setUp()
    {
        $this->sut = new Plan([
            'name' => 'name',
            'code' => 'code',
            'dbLimit' => 2,
            'storageLimit' => 10,
            'bandwidthLimit' => 300,
            'descr' => 'descr',
            'price' => 99,
            'recommendedSize' => 'recommendedSize',
            'templateBody' => 'templateBody'
        ]);
    }

    public function testProperty()
    {
        $this->assertEquals('name', $this->sut->getName());
        $this->assertEquals('code', $this->sut->getCode());
        $this->assertEquals(2, $this->sut->getDbLimit());
        $this->assertEquals(10, $this->sut->getStorageLimit());
        $this->assertEquals(300, $this->sut->getBandwidthLimit());
        $this->assertEquals('descr', $this->sut->getDescription());
        $this->assertEquals(99, $this->sut->getPrice());
        $this->assertEquals('recommendedSize', $this->sut->getRecommendedSize());
        $this->assertEquals('templateBody', $this->sut->getTemplate());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBadConstruct()
    {
        new Plan(['yolo' => true]);
    }

}
