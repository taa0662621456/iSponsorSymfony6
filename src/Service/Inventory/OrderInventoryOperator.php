<?php


namespace App\Service\Inventory;

use App\Interface\Order\OrderInterface;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;


final class OrderInventoryOperator implements OrderInventoryOperatorInterface
{
    public function __construct(
        private readonly OrderInventoryOperatorInterface $decoratedOperator,
        private readonly EntityManagerInterface          $productVariantManager,
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
     * @throws OptimisticLockException|PessimisticLockException
     */
    public function hold(OrderInterface $order): void
    {
        $this->lockProductVariants($order);

        $this->decoratedOperator->hold($order);
    }

    /**
     * @throws OptimisticLockException|PessimisticLockException
     */
    public function sell(OrderInterface $order): void
    {
        $this->lockProductVariants($order);

        $this->decoratedOperator->sell($order);
    }

    /**
     * @throws OptimisticLockException|PessimisticLockException
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
