<?php
declare(strict_types=1);

namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="orders_histories", indexes={
 * @ORM\Index(name="order_history_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderHistory
{
	use BaseTrait;

	/**
	 * @var string
	 *
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\OrderStatus")
	 * @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
	 */
	private string $orderStatusCode;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="customer_notified", type="boolean", nullable=false)
	 */
	private bool $customerNotified = false;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="comments", type="string", nullable=true, options={"default" : 0})
	 */
	private ?string $comments = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="o_hash", type="string", nullable=true, options={"default" : 0})
	 */
	private ?string $oHash = '0';


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
	 * @return bool
	 */
	public function isCustomerNotified(): bool
	{
		return $this->customerNotified;
	}

	/**
	 * @param bool $customerNotified
	 */
	public function setCustomerNotified(bool $customerNotified): void
	{
		$this->customerNotified = $customerNotified;
	}

	/**
	 * @return string|null
	 */
	public function getComments(): ?string
	{
		return $this->comments;
	}

	/**
	 * @param string|null $comments
	 */
	public function setComments(?string $comments): void
	{
		$this->comments = $comments;
	}

	/**
	 * @return string|null
	 */
	public function getOHash(): ?string
	{
		return $this->oHash;
	}

	/**
	 * @param string|null $oHash
	 */
	public function setOHash(?string $oHash): void
	{
		$this->oHash = $oHash;
	}

}
