<?php

namespace App\Service;

interface StockServiceInterface
{
    public function isAvailable(int $productId, int $qty): bool;
    public function isAvailableForLine(string $lineId, int $qty): bool;
}