<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * PlanController is a controller for purchasing Plan
 */
class PlanController extends FrontTemplate
{

    public function listAction()
    {
        $plan = $this->get('portal.plan.repository')->all();

        return $this->render('TrismegistePortalBundle:Plan:list.html.twig', ['plan' => $plan]);
    }

    public function checkoutAction($sku)
    {
        try {
            $cart = $this->get('portal.plan.repository')->createCart($sku);
            $this->get('session')->set('order', $cart);
        } catch (\OutOfRangeException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $this->redirect($this->generateUrl('order_next_step'));
    }

}
