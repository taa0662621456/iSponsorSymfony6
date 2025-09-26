<?php

namespace App\Service;

use App\Entity\Order\OrderStorage;

interface ShipmentServiceInterface
{
    public function setMethod(OrderStorage $order, string $methodCode, object $by): array;
    public function setTracking(OrderStorage $order, string $carrier, string $tracking, object $by): array;
}
