<?php
namespace App\Event\Order;

use App\Entity\Order\OrderStorage;

final class OrderCompletedEvent
{
    public function __construct(public readonly OrderStorage $order) {}
}
