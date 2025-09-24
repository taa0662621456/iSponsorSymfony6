<?php

namespace App\DTO;

use App\Enum\TaxMode;
use App\ValueObject\Money;

final class CartSnapshot
{
    /** @param CartItem[] $items */
    public function __construct(
        public readonly array $items,
        public readonly TaxMode $taxMode = TaxMode::EXCLUSIVE,
        public readonly ?string $shippingMethod = null,
        /** @var string[] */
        public readonly array $coupons = [],
        public readonly string $currency = 'USD'
    ) {
        foreach ($items as $item) {
            if (!$item instanceof CartItem) {
                throw new \InvalidArgumentException('items must be CartItem[]');
            }
            if ($item->unitPrice->currency() !== $this->currency) {
                throw new \InvalidArgumentException('Currency mismatch between items and cart.');
            }
        }
    }
}
