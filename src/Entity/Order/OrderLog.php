<?php

namespace App\Entity\Order;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Order\OrderRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'order_log')]
#[ORM\Index(columns: ['slug'], name: 'order_log_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class OrderLog
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;

	#[ORM\ManyToOne(targetEntity: OrderStatus::class)]
	private OrderStatus $orderStatusCode;

	#[ORM\Column(name: 'customer_notified', type: 'boolean', nullable: false)]
	private bool $customerNotified = false;

	#[ORM\Column(name: 'comment')]
	private ?string $comment = null;

	#[ORM\Column(name: 'o_hash')]
	private ?string $oHash = null;

    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
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
	public function getComment(): ?string
	{
		return $this->comment;
	}
	public function setComment(?string $comment): void
	{
		$this->comment = $comment;
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
