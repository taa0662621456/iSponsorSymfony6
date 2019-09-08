<?php
declare(strict_types=1);

namespace App\Event;

use App\Entity\Order\Orders;
use Symfony\Contracts\EventDispatcher\Event;

class OrderSubmitedEvent extends Event
{
    public const NAME = 'orders.order';

    /**
     * @var Orders
     */
    private $orderSubmited;

    /**
     * @param Orders $orderSubmited
     */
    public function __construct(Orders $orderSubmited)
    {
        $this->orderSubmited = $orderSubmited;
    }

    /**
     * @return Orders
     */
    public function getOrderSubmited(): Orders
    {
        return $this->orderSubmited;
    }
}
