<?php
declare(strict_types=1);

namespace App\Entity\Order;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


/**
 * OrderHistories
 *
 * @ORM\Table(name="order_histories")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrderHistories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order\OrdersStatus")
     * @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
     */
    private $orderStatusCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customer_notified", type="boolean", nullable=false)
     */
    private $customerNotified = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comments", type="string", nullable=true, options={"default":0})
     */
    private $comments = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="o_hash", type="string", nullable=true, options={"default":0})
     */
    private $oHash = '0';

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
    private $createdBy;

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
     * OrderHistories constructor.
     * @throws \Exception
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
