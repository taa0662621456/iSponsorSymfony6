<?php

namespace App\Service;

use App\DTO\CartSnapshot;

interface CartServiceInterface
{
    public function getCurrent(): CartSnapshot;         // DTO корзины
    public function add(int $productId, int $qty): void;
    public function updateQty(string $lineId, int $qty): void; // qty=0 => удалить
}
