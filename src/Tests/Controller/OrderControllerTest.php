<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Tests\Controller;

/**
 * OrderControllerTest tests the Order ctrlr
 */
class OrderControllerTest extends ControllerTestCase
{

    public function testCheckout()
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->generateUrl('front_plan_list'));
        $button = $crawler->selectButton('Choose');
        $this->client->submit($button->form());
        $this->assertRoute('trismegiste_oauth_connect');
    }

}
