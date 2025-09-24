<?php

namespace App\Service;

use App\Entity\Order\OrderItem;

interface OrderItemServiceInterface
{
    public function updateQty(OrderItem $item, int $qty, object $by): array; // возвращает DTO строки/заказа
}