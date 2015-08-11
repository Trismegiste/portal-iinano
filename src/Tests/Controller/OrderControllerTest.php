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

    public function testCheckoutWithoutAuth()
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->generateUrl('front_plan_list'));
        $button = $crawler->selectButton('Choose');
        $this->client->submit($button->form());
        $this->assertInstanceOf('Trismegiste\PortalBundle\Model\Order', $this->client->getRequest()->getSession()->get('order'));
        $this->assertRoute('trismegiste_oauth_connect');
    }

    public function testCheckoutWithPreviousAuth()
    {
        $crawler = $this->client->request('GET', $this->generateUrl('trismegiste_oauth_connect'));
        $link = $crawler->filter('i[class="icon-dummy-sign"]')->parents()->link();
        $crawler = $this->client->click($link);
        $crawler->selectButton('Redirect');
    }

}
