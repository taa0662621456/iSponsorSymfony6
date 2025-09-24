<?php

namespace App\Service;

use App\Entity\Order\OrderStorage;

interface PaymentFacadeInterface
{
    public function init(OrderStorage $order, ?string $idempotencyKey = null): array;  // возвращает данные платежной сессии
    public function retry(OrderStorage $order, ?string $idempotencyKey = null): array;
}