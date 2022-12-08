<?php


namespace App\Repository\ORM_Sylius\Inventory\Operator;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;




final class OrderInventoryOperator implements OrderInventoryOperatorInterface
{
    public function __construct(
        private OrderInventoryOperatorInterface $decoratedOperator,
        private EntityManagerInterface $productVariantManager,
    ) {
    }

    /**
     * @throws OptimisticLockException
     */
    public function cancel(OrderInterface $order): void
    {
        $this->lockProductVariants($order);

        $this->decoratedOperator->cancel($order);
    }

    /**
     * @throws OptimisticLockException
     */
    public function hold(OrderInterface $order): void
    {
        $this->lockProductVariants($order);

        $this->decoratedOperator->hold($order);
    }

    /**
     * @throws OptimisticLockException
     */
    public function sell(OrderInterface $order): void
    {
        $this->lockProductVariants($order);

        $this->decoratedOperator->sell($order);
    }

    /**
     * @throws OptimisticLockException
     */
    private function lockProductVariants(OrderInterface $order): void
    {
        /** @var OrderItemInterface $orderItem */
        foreach ($order->getItems() as $orderItem) {
            $variant = $orderItem->getVariant();

            if (!$variant->isTracked()) {
                continue;
            }

            $this->productVariantManager->lock($variant, LockMode::OPTIMISTIC, $variant->getVersion());
        }
    }
}
