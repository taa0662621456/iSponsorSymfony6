<?php

namespace App\Service;

use App\Entity\Order\OrderStorage;

interface OrderServiceInterface
{
    public function dto(OrderStorage $order): array;
    public function cancel(OrderStorage $order, object $by): void;
}
