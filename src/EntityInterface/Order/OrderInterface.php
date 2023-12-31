<?php

namespace App\EntityInterface\Order;

use Doctrine\Common\Collections\Collection;

interface OrderInterface
{

    public const STATE_CART = 'cart';

    public const STATE_NEW = 'new';

    public const STATE_CANCELLED = 'cancelled';

    public const STATE_FULFILLED = 'fulfilled';

    public function getCheckoutCompletedAt(): ?\DateTimeInterface;

    public function setCheckoutCompletedAt(?\DateTimeInterface $checkoutCompletedAt): void;

    public function isCheckoutCompleted(): bool;

    public function completeCheckout(): void;


    public function setNumber(?string $number): void;

    public function getNotes(): ?string;

    public function setNotes(?string $notes): void;

    /**
     * @return Collection
     *
     * @psalm-return Collection<array-key, OrderItemInterface>
     */
    public function getItems(): Collection;

    public function clearItems(): void;

    public function countItems(): int;

    public function addItem(OrderItemInterface $item): void;

    public function removeItem(OrderItemInterface $item): void;

    public function hasItem(OrderItemInterface $item): bool;

    public function getItemsTotal(): int;

    public function recalculateItemsTotal(): void;

    public function getTotal(): int;

    public function getTotalQuantity(): int;

    public function getState(): string;

    public function setState(string $state): void;

    public function isEmpty(): bool;

    /**
     * @return Collection|AdjustmentInterface[]
     *
     * @psalm-return Collection<array-key, AdjustmentInterface>
     */
    public function getAdjustmentsRecursively(?string $type = null): Collection;

    public function getAdjustmentsTotalRecursively(?string $type = null): int;

    public function removeAdjustmentsRecursively(?string $type = null): void;

}