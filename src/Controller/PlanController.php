<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

}
