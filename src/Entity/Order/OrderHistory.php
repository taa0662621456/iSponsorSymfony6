<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Repository\Order\OrderRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'orders_histories')]
#[ORM\Index(columns: ['slug'], name: 'order_history_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderHistory
{
	use BaseTrait;
	#[ORM\ManyToOne(targetEntity: OrderStatus::class)]
	#[ORM\JoinColumn(name: 'order_status_id', referencedColumnName: 'id')]
	private OrderStatus $orderStatusCode;

	#[ORM\Column(name: 'customer_notified', type: 'boolean', nullable: false)]
	private bool $customerNotified = false;

	#[ORM\Column(name: 'comments', type: 'string', nullable: true, options: ['default' => 0])]
	private ?string $comments = '0';

	#[ORM\Column(name: 'o_hash', type: 'string', nullable: true, options: ['default' => 0])]
	private ?string $oHash = '0';

	public function getOrderStatusCode(): OrderStatus
    {
		return $this->orderStatusCode;
	}
	public function setOrderStatusCode($orderStatusCode): void
	{
		$this->orderStatusCode = $orderStatusCode;
	}
	public function isCustomerNotified(): bool
	{
		return $this->customerNotified;
	}
	public function setCustomerNotified(bool $customerNotified): void
	{
		$this->customerNotified = $customerNotified;
	}
	public function getComments(): ?string
	{
		return $this->comments;
	}
	public function setComments(?string $comments): void
	{
		$this->comments = $comments;
	}
	public function getOHash(): ?string
	{
		return $this->oHash;
	}
	public function setOHash(?string $oHash): void
	{
		$this->oHash = $oHash;
	}
}
