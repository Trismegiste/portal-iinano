<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Controller;

/**
 * FrontControllerTest tests the front controller
 */
class FrontControllerTest extends ControllerTestCase
{

    public function testHomepage()
    {
        $crawler = $this->client->request('GET', $this->generateUrl('front_index'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThanOrEqual(3, count($crawler->filter('.content a:contains("iinano")')));
    }

    public function testConnect()
    {
        $crawler = $this->client->request('GET', $this->generateUrl('trismegiste_oauth_connect'));
        file_put_contents('wesh.html', $this->client->getResponse());
        $this->assertCount(1, $crawler->filter('i[class="icon-facebook-sign"]'));
    }

}
