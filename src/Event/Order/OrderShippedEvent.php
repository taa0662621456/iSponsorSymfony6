<?php
namespace App\Event\Order;

use App\Entity\Order\OrderStorage;

final class OrderShippedEvent
{
    public function __construct(public readonly OrderStorage $order) {}
}
