<?php

namespace App\Service\Cart;

use App\Exception\CartNotFoundException;
use App\Interface\Cart\CartContextInterface;

class CartContext implements CartContextInterface
{

    public function getCart(): string
    {
        // TODO: Implement getCart() method.
        return '';
    }
}
