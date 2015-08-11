<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * ControllerTestCase is a test case template for testing controller
 */
class ControllerTestCase extends WebTestCase
{

    /** @var Client A Client instance */
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

    protected function assertRoute($route, $param = [])
    {
        $uri = $this->getService('router')->generate($route, $param, UrlGeneratorInterface::ABSOLUTE_URL);
        $this->assertEquals($uri, $this->client->getRequest()->getUri());
    }

}
