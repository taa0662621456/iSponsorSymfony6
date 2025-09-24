<?php

namespace App\DTO;

use App\ValueObject\Money;

final class CartPricing
{
    public function __construct(
        public readonly Money $itemsSubtotal,
        public readonly Money $discountTotal,
        public readonly Money $shippingTotal,
        public readonly Money $taxTotal,
        public readonly Money $grandTotal
    ) {}
}
