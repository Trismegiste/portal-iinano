<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Controller;

/**
 * FrontControllerTest tests the front controller
 */
class FrontControllerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    protected $client;

    protected function getService($id)
    {
        return $this->client->getContainer()->get($id);
    }

    protected function generateUrl($route, $param = [])
    {
        return $this->getService('router')->generate($route, $param);
    }

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testHomepage()
    {
        $crawler = $this->client->request('GET', $this->generateUrl('front_index'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThanOrEqual(3, count($crawler->filter('.content a:contains("iinano")')));
    }

}
