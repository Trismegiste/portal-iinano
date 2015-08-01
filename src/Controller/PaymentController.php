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
        return $this->render('TrismegistePortalBundle:Payment:paynow.html.twig');
    }

    public function returnFromPaymentAction()
    {
        $info = [];
        $this->getCart()->makeItPaid($info);

        $this->redirect($this->generateUrl('order_next_step'));
    }

}
