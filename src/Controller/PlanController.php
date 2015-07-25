<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * PlanController is a controller for purchasing Plan
 */
class PlanController extends Controller
{

    public function listAction()
    {
        $plan = $this->get('portal.plan.repository')->all();

        return $this->render('TrismegistePortalBundle:Plan:list.html.twig', ['plan' => $plan]);
    }

    public function checkoutAction($sku)
    {
        try {
            $plan = $this->get('portal.plan.repository')->findBySku($sku);
            $this->get('session')->set('cart', $plan);
            $this->get('session')->set('action', 'checkout');  // FINITE STATE MACHINE
        } catch (\OutOfRangeException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $this->redirect($this->generateUrl('trismegiste_oauth_connect'));
    }

}
