<?php
declare(strict_types=1);

namespace App\Entity\Order;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Table(name="orders_status")
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrdersStatus
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     * ORM\ManyToOne(targetEntity="App\Entity\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     * ORM\ManyToOne(targetEntity="App\Entity\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $modifiedBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     * ORM\ManyToOne(targetEntity="App\Entity\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $lockedBy = 0;
















    /**
     * OrdersStatus constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->createdOn = new DateTime();
    }

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
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

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @param DateTime $createdOn
     */
    public function setCreatedOn(DateTime $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */
    public function getModifiedOn(): DateTime
    {
        return $this->modifiedOn;
    }

    /**
     * @param DateTime $modifiedOn
     */
    public function setModifiedOn(DateTime $modifiedOn): void
    {
        $this->modifiedOn = $modifiedOn;
    }

    /**
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(DateTime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }














}
