<?php


namespace App\Event\Order;

use App\Entity\Order\OrderStorage;
use App\Event\OrderEvent;

class OrderSubmitEvent extends OrderEvent
{
    public const NAME = 'name';

    /**
     * @param OrderStorage $orderSubmitted
     */
    public function __construct(private readonly OrderStorage $orderSubmitted)
    {
    }

    /**
     * @return OrderStorage
     */
    public function getOrderSubmitted(): OrderStorage
    {
        return $this->orderSubmitted;
    }
}