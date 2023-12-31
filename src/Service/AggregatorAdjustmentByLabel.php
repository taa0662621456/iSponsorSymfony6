<?php

namespace App\Service;

final class AggregatorAdjustmentByLabel
{
    public function aggregate(iterable $adjustments): array
    {
        $aggregatedAdjustments = [];
        foreach ($adjustments as $adjustment) {
            if (!isset($aggregatedAdjustments[$adjustment->getLabel()])) {
                $aggregatedAdjustments[$adjustment->getLabel()] = 0;
            }

            $aggregatedAdjustments[$adjustment->getLabel()] += $adjustment->getAmount();
        }

        return $aggregatedAdjustments;
    }
}
