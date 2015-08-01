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
        define('PREFIX', 'Trismegiste\PortalBundle\Model\State\\');

        switch (get_class($this->getCart()->getState())) {
            case PREFIX . 'Cart' :
                $url = $this->generateUrl("trismegiste_oauth_connect");
                break;
            case PREFIX . 'Authenticated' :
                $url = $this->generateUrl("payment_paynow");
                break;
            case PREFIX . 'Paid' :
                $url = $this->generateUrl("front_plan_deploy", ['id' => $this->getCart()->getId()]);
                break;
        }

        return $this->redirect($url);
    }

    public function deployAction($id)
    {
        return new \Symfony\Component\HttpFoundation\Response('deploy');
    }

}
