<?php

use Symfony\Component\Security\Core\User\UserInterface;

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model\State;

/**
 * OrderStateInterface is a contract for a State of a Cart/Order/Invoice
 */
interface OrderStateInterface
{

    public function setAuthenticated();

    public function canCapture();

    public function createStack();

    public function commitStack();

    public function doPayment();

    public function failedStack();

    public function failedPayment();
}