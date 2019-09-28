<?php
declare(strict_types=1);

namespace App\Entity\Order;

use App\Entity\EntitySystemTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders_status", indexes={
 * @ORM\Index(name="order_status_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrdersStatus
{
	use EntitySystemTrait;

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
	 * @var boolean
	 *
	 * @ORM\Column(name="published", type="boolean", nullable=false, options={"default" : 1})
	 */
	private $published = true;


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
	 * @return bool
	 */
	public function isPublished(): bool
	{
		return $this->published;
	}

	/**
	 * @param bool $published
	 */
	public function setPublished(bool $published): void
	{
		$this->published = $published;
	}


}
