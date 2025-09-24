<?php

namespace App\Service;

use App\DTO\CartPricing;
use App\DTO\CartSnapshot;

interface PriceCalculatorInterface
{
    public function recalculate(CartSnapshot $cart): CartPricing; // применяет цены/налоги/купоны
    public function applyCoupon(CartSnapshot $cart, string $code): CartPricing;
}