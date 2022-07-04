<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Repository\Order\OrderStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'orders_status')]
#[ORM\Index(columns: ['slug'], name: 'order_status_idx')]
#[ORM\Entity(repositoryClass: OrderStatusRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderStatus
{
	use BaseTrait;

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
	#[ORM\OneToMany(mappedBy: 'orderStatus', targetEntity: Order::class)]
	private Collection $orders;
	public function __construct()
	{
		$this->orders = new ArrayCollection();
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
	public function getOrders(): ArrayCollection
	{
		return $this->orders;
	}
	/**
	 * @return OrderStatus
	 */
	public function addOrder(Order $order): static
    {
		if (!$this->orders->contains($order)) {
			$order->setOrderStatus($this);
			$this->orders->add($order);
		}

		return $this;

	}
	public function removeOrder(Order $order): void
    {
		if (!$this->orders->contains($order)) {
			$this->orders->removeElement($order);
		}
	}
}
