<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Order\OrderRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


#[ORM\Table(name: 'order_logs')]
#[ORM\Index(columns: ['slug'], name: 'order_log_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderLog
{
	use BaseTrait;
    use ObjectTrait;

	#[ORM\ManyToOne(targetEntity: OrderStatus::class)]
	private OrderStatus $orderStatusCode;

	#[ORM\Column(name: 'customer_notified', type: 'boolean', nullable: false)]
	private bool $customerNotified = false;

	#[ORM\Column(name: 'comments')]
	private ?string $comments = null;

	#[ORM\Column(name: 'o_hash')]
	private ?string $oHash = null;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
    #
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
