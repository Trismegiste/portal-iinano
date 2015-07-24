<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

use Trismegiste\Yuurei\Persistence\Persistable;

/**
 * Order is a customer's order embedding the User and the Product
 */
class Order implements Persistable
{

    use \Trismegiste\Yuurei\Persistence\PersistableImpl;
}
