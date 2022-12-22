<?php

namespace App\Factory;

use App\OrderInterface;

class AddToCartCommandFactory
{
    public function createWithCartAndCartItem(OrderInterface $cart, OrderItemInterface $cartItem): AddToCartCommand
    {
        return new AddToCartCommand($cart, $cartItem);
    }
}
