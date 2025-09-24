<?php

namespace App\Service;


final class StockChecker implements AvailabilityCheckerInterface
{
    public function isStockAvailable(StockableInterface $stockable): bool
    {
        return $this->isStockSufficient($stockable, 1);
    }

    public function isStockSufficient(StockableInterface $stockable, int $quantity): bool
    {
        return !$stockable->isTracked() || $quantity <= ($stockable->getOnHand() - $stockable->getOnHold());
    }
}