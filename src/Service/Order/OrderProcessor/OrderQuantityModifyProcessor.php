<?php

namespace App\Service\Order\OrderProcessor;

use App\EntityInterface\Order\OrderItemInterface;
use App\FactoryInterface\Order\OrderItemUnitFactoryInterface;
use App\ServiceInterface\Order\OrderQuantityModifierInterface;

class OrderQuantityModifyProcessor implements OrderQuantityModifierInterface
{
    public function __construct(private readonly OrderItemUnitFactoryInterface $orderItemUnitFactory)
    {
    }

    public function modify(OrderItemInterface $orderItem, int $targetQuantity): void
    {
        $currentQuantity = $orderItem->getQuantity();
        if (0 >= $targetQuantity || $currentQuantity === $targetQuantity) {
            return;
        }

        if ($targetQuantity < $currentQuantity) {
            $this->decreaseUnitsNumber($orderItem, $currentQuantity - $targetQuantity);
        } elseif ($targetQuantity > $currentQuantity) {
            $this->increaseUnitsNumber($orderItem, $targetQuantity - $currentQuantity);
        }
    }

    private function increaseUnitsNumber(OrderItemInterface $orderItem, int $increaseBy): void
    {
        for ($i = 0; $i < $increaseBy; $i++) {
            $this->orderItemUnitFactory->createForItem($orderItem);
        }
    }

    private function decreaseUnitsNumber(OrderItemInterface $orderItem, int $decreaseBy): void
    {
        foreach ($orderItem->getUnits() as $unit) {
            if (0 >= $decreaseBy--) {
                break;
            }

            $orderItem->removeUnit($unit);
        }
    }
}