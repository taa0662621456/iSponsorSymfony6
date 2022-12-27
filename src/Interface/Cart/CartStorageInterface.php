<?php

namespace App\Interface\Cart;

use App\Interface\Order\OrderInterface;

interface CartStorageInterface
{

    public function setForChannel($getChannel, OrderInterface $cart);
}
