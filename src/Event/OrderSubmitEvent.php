<?php


namespace App\Event;

use App\Entity\Order\OrderStorage;
use Symfony\Contracts\EventDispatcher\Event;

class OrderSubmitEvent extends Event
{
    public const NAME = 'orders.order';

    /**
     * @param OrderStorage $orderSubmited
     */
    public function __construct(private readonly OrderStorage $orderSubmited)
    {
    }

    /**
     * @return OrderStorage
     */
    public function getOrderSubmited(): OrderStorage
    {
        return $this->orderSubmited;
    }
}
