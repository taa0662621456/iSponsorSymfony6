<?php

namespace App\Interface\Cart;

use App\Exception\CartNotFoundException;

interface CartContextInterface
{
    /**
     * @throws CartNotFoundException
     */
    public function getCart();
}
