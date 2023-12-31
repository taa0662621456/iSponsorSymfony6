<?php

namespace App\Service\Cart;

use App\Entity\Order\OrderStorage;
use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Cart\CartContextServiceInterface;

class CartContextService implements CartContextServiceInterface
{
    public function getCart(): OrderStorageInterface
    {
        return new OrderStorage;
    }
}
