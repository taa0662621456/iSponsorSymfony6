<?php

namespace App\Service\Order;

use App\Entity\Order;
use App\Repository\DiscountRepository;
use App\Repository\TaxationRepository;

class OrderCalculator
{
    public function __construct(
        private readonly DiscountRepository $discountRepository,
        private readonly TaxationRepository $taxationRepository
    ) {}

    public function recalculate(OrderStorage $order): void
    {
        $subtotal = 0;
        foreach ($order->getItems() as $item) {
            $subtotal += $item->getQuantity() * $item->getUnitPrice();
        }

        $discounts = $this->discountRepository->getApplicableDiscounts($order);
        $discountTotal = array_sum(array_map(fn($d) => $d->apply($order), $discounts));

        $taxTotal = $this->taxationRepository->calculateTax($order, $subtotal - $discountTotal);

        $order->setSubtotal($subtotal);
        $order->setDiscountTotal($discountTotal);
        $order->setTaxTotal($taxTotal);
        $order->setGrandTotal($subtotal - $discountTotal + $taxTotal);
    }
}
