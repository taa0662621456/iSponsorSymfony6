<?php


namespace App\Event;

use App\Entity\Order\Orders;
use Symfony\Contracts\EventDispatcher\Event;

class OrderSubmitEvent extends Event
{
    public const NAME = 'orders.order';

    /**
     * @param Orders $orderSubmited
     */
    public function __construct(private Orders $orderSubmited)
    {
    }

    /**
     * @return Orders
     */
    public function getOrderSubmited(): Orders
    {
        return $this->orderSubmited;
    }
}
