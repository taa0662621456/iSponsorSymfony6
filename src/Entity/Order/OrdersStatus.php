<?php
declare(strict_types=1);

namespace App\Entity\Order;

use App\Entity\BaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders_status", indexes={
 * @ORM\Index(name="order_status_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdersStatusRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrdersStatus
{
	use BaseTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_status_code", type="string", nullable=false, options={"default"=""})
	 */
	private $orderStatusCode = '';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_status_name", type="string", nullable=true, options={"default"="0"})
	 */
	private $orderStatusName = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_status_color", type="string", nullable=true, options={"default"="0"})
	 */
	private $orderStatusColor = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_status_description", type="string", nullable=true, options={"default"="0"})
	 */
	private $orderStatusDescription = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_stock_handle", type="string", nullable=false, options={"default"="A"})
	 */
	private $orderStockHandle = 'A';

	/**
	 * @var int
	 *
	 * @ORM\Column(name="ordering", type="integer", nullable=false)
	 */
	private $ordering = 0;

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\Orders", mappedBy="orderStatus")
	 */
	private $orders;

	public function __construct()
	{
		$this->orders = new ArrayCollection();
	}

	/**
	 * @return string
	 */
	public function getOrderStatusCode(): string
	{
		return $this->orderStatusCode;
	}

	/**
	 * @param string $orderStatusCode
	 */
	public function setOrderStatusCode(string $orderStatusCode): void
	{
		$this->orderStatusCode = $orderStatusCode;
	}

	/**
	 * @return string|null
	 */
	public function getOrderStatusName(): ?string
	{
		return $this->orderStatusName;
	}

	/**
	 * @param string|null $orderStatusName
	 */
	public function setOrderStatusName(?string $orderStatusName): void
	{
		$this->orderStatusName = $orderStatusName;
	}

	/**
	 * @return string|null
	 */
	public function getOrderStatusColor(): ?string
	{
		return $this->orderStatusColor;
	}

	/**
	 * @param string|null $orderStatusColor
	 */
	public function setOrderStatusColor(?string $orderStatusColor): void
	{
		$this->orderStatusColor = $orderStatusColor;
	}

	/**
	 * @return string|null
	 */
	public function getOrderStatusDescription(): ?string
	{
		return $this->orderStatusDescription;
	}

	/**
	 * @param string|null $orderStatusDescription
	 */
	public function setOrderStatusDescription(?string $orderStatusDescription): void
	{
		$this->orderStatusDescription = $orderStatusDescription;
	}

	/**
	 * @return string
	 */
	public function getOrderStockHandle(): string
	{
		return $this->orderStockHandle;
	}

	/**
	 * @param string $orderStockHandle
	 */
	public function setOrderStockHandle(string $orderStockHandle): void
	{
		$this->orderStockHandle = $orderStockHandle;
	}

	/**
	 * @return int
	 */
	public function getOrdering(): int
	{
		return $this->ordering;
	}

	/**
	 * @param int $ordering
	 */
	public function setOrdering(int $ordering): void
	{
		$this->ordering = $ordering;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getOrders(): ArrayCollection
	{
		return $this->orders;
	}

	/**
	 * @param Orders $order
	 *
	 * @return OrdersStatus
	 */
	public function addOrder(Orders $order)
	{
		if (!$this->orders->contains($order)) {
			$order->setOrderStatus($this);
			$this->orders->add($order);
		}

		return $this;

	}

	/**
	 * @param Orders $order
	 */
	public function removeOrder(Orders $order)
	{
		if (!$this->orders->contains($order)) {
			$this->orders->removeElement($order);
		}
	}
}
