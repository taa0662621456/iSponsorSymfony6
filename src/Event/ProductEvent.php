<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ProductEvent extends Event
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const PRODUCT_CREATED = 'product.created';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const PRODUCT_UPDATED = 'product.updated';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const PRODUCT_DELETED = 'product.deleted';

}
