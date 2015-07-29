<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

/**
 * PaymentController manages payments
 */
class PaymentController extends FrontTemplate
{

    public function payNowAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('pay');
    }

}
