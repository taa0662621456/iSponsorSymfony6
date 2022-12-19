<?php

namespace App\Service\Cart;

use App\Exception\CartNotFoundException;
use App\Interface\CartContextInterface;
use App\OrderInterface;

class CartContext implements CartContextInterface
{

    public function getCart(): string
    {
        // TODO: Implement getCart() method.
        return '';
    }
}
