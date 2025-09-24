<?php

namespace App\Factory;

use App\Interface\Order\OrderInterface;

class AddToCartCommandFactory
{
    public function createWithCartAndCartItem(OrderInterface $cart, OrderItemInterface $cartItem): AddToCartCommand
    {
        return new AddToCartCommand($cart, $cartItem);
    }
}