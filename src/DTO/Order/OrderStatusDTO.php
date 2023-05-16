<?php

namespace App\DTO\Order;


use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ApiResource(mercure: true)]
final class OrderStatusDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private string $orderStatusCode = '';

    private ?string $orderStatusName = null;

    private ?string $orderStatusColor = null;

    private ?string $orderStatusDescription = null;

    private string $orderStockHandle = 'A';

    private int $ordering = 0;
    /**
     * @var ArrayCollection
     */
    private Collection $orderStatusStorageDTO;

    public function __construct()
    {
        $t = new DateTime();
        $this->orderStatusStorage = new ArrayCollection();
    }

    public function getOrderStatusCode(): string
    {
        return $this->orderStatusCode;
    }

    public function setOrderStatusCode(string $orderStatusCode): void
    {
        $this->orderStatusCode = $orderStatusCode;
    }

    public function getOrderStatusName(): ?string
    {
        return $this->orderStatusName;
    }

    public function setOrderStatusName(?string $orderStatusName): void
    {
        $this->orderStatusName = $orderStatusName;
    }

    public function getOrderStatusColor(): ?string
    {
        return $this->orderStatusColor;
    }

    public function setOrderStatusColor(?string $orderStatusColor): void
    {
        $this->orderStatusColor = $orderStatusColor;
    }

    public function getOrderStatusDescription(): ?string
    {
        return $this->orderStatusDescription;
    }

    public function setOrderStatusDescription(?string $orderStatusDescription): void
    {
        $this->orderStatusDescription = $orderStatusDescription;
    }

    public function getOrderStockHandle(): string
    {
        return $this->orderStockHandle;
    }

    public function setOrderStockHandle(string $orderStockHandle): void
    {
        $this->orderStockHandle = $orderStockHandle;
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    // OneToMany
    public function getOrderStatusStorage(): Collection
    {
        return $this->orderStatusStorage;
    }

    public function addOrderStorage(OrderStorage $orderStorage): self
    {
        if (!$this->orderStatusStorage->contains($orderStorage)) {
            $this->orderStatusStorage[] = $orderStorage;
        }

        return $this;
    }

    public function removeOrderStorage(OrderStorage $orderStorage): self
    {
        if ($this->orderStatusStorage->contains($orderStorage)) {
            $this->orderStatusStorage->removeElement($orderStorage);
        }

        return $this;
    }
}
