<?php

namespace App\Entity\Order;

use ApiPlatform\Doctrine\Common\Filter\OrderFilterTrait;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\ObjectTrait;
use DateTime;
use App\Entity\BaseTrait;
use App\Repository\Order\OrderStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'order_status')]
#[ORM\Index(columns: ['slug'], name: 'order_status_idx')]
#[ORM\Entity(repositoryClass: OrderStatusRepository::class)]
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
class OrderStatus
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use StatusFilterTrait;

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
    #
	public function __construct()
	{
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->orderStatusStorage = new ArrayCollection();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
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
    # OneToMany
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
