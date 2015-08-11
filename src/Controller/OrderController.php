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

    public function checkoutAction($sku)
    {
        try {
            $cart = $this->get('portal.plan.repository')->createCart($sku);
            if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
                $cart->authenticateWith($this->getUser());
            }
            $this->get('session')->set('order', $cart);
        } catch (\OutOfRangeException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $this->redirect($this->generateUrl('front_order_next_step'));
    }

    public function nextStepAction()
    {
        define('PREFIX', 'Trismegiste\PortalBundle\Model\State\\');

        switch (get_class($this->getCart()->getState())) {
            case PREFIX . 'Cart' :
                $url = $this->generateUrl("trismegiste_oauth_connect");
                break;
            case PREFIX . 'Authenticated' :
                $url = $this->generateUrl("front_payment_paynow");
                break;
            case PREFIX . 'Paid' :
                $url = $this->generateUrl("front_plan_deploy", ['id' => $this->getCart()->getId()]);
                break;
        }

        return $this->redirect($url);  // @todo use a forward ?
    }

    public function deployAction($id)
    {
        return new \Symfony\Component\HttpFoundation\Response('deploy');
    }

}
