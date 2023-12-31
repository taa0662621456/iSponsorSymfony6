<?php

namespace App\Service\Order;

use App\Entity\Order\OrderStorage;
use App\EntityInterface\Order\OrderStorageInterface;
use App\ServiceInterface\Cart\CartContextServiceInterface;

class OrderContext implements CartContextServiceInterface
{
    public function getCart(): OrderStorageInterface
    {
        return new OrderStorage;
    }
}
