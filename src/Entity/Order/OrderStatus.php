<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Order\OrderStatusInterface;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
final class OrderStatus extends ObjectSuperEntity implements ObjectInterface, OrderStatusInterface
{
    #[ORM\Column(name: 'order_status_code', type: 'string', nullable: false, options: ['default' => ''])]
    private string $orderStatusCode = '';

    #[ORM\Column(name: 'order_status_name', nullable: true)]
    private ?string $orderStatusName = null;

    #[ORM\Column(name: 'order_status_color', nullable: true)]
    private ?string $orderStatusColor = null;

    #[ORM\Column(name: 'order_status_description', nullable: true)]
    private ?string $orderStatusDescription = null;

    #[ORM\Column(name: 'order_stock_handle', type: 'string', nullable: false, options: ['default' => 'A'])]
    private string $orderStockHandle = 'A';

    #[ORM\Column(name: 'ordering', type: 'integer', nullable: false)]
    private int $ordering = 0;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'orderStatus', targetEntity: OrderStorage::class)]
    private Collection $orderStatusStorage;

    public function __construct()
    {
        $t = new \DateTime();
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
