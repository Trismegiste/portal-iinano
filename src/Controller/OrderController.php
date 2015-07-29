<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

/**
 * OrderController is a controller for step-by-step order processing & fulfillment
 */
class OrderController extends FrontTemplate
{

    public function nextStepAction()
    {
        switch (get_class($this->getCart()->getState())) {
            case 'Trismegiste\PortalBundle\Model\State\Cart' :
                $path = "trismegiste_oauth_connect";
                break;
            case 'Trismegiste\PortalBundle\Model\State\Authenticated' :
                $path = "payment_paynow";
                break;
        }

        return $this->redirect($this->generateUrl($path));
    }

}
