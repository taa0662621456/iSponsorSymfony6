<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class CartEvent extends Event
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const CART_ADD_PRODUCT = 'cart.add_product';
}