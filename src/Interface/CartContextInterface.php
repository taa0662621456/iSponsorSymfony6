<?php

namespace App\Interface;

use App\Exception\CartNotFoundException;
use App\OrderInterface;

interface CartContextInterface
{
    /**
     * @throws CartNotFoundException
     */
    public function getCart();
}
