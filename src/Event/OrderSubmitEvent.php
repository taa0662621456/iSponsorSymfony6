<?php


namespace App\Event;

use App\Entity\Order\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderSubmitEvent extends Event
{
    public const NAME = 'orders.order';

    /**
     * @param Order $orderSubmited
     */
    public function __construct(private readonly Order $orderSubmited)
    {
    }

    /**
     * @return Order
     */
    public function getOrderSubmited(): Order
    {
        return $this->orderSubmited;
    }
}
