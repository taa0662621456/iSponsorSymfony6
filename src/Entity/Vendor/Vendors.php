<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\Order\Orders;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="vendors", uniqueConstraints={
 * @ORM\UniqueConstraint(name="vendor_slug", columns={"vendor_slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * @UniqueEntity("vendor_slug"),
 *		errorPath="vendor_slug",
 *		message="This name is already in use."
 * @ORM\HasLifecycleCallbacks()
 */
class Vendors
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var bool|false
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default" : 0})
     */
    private $active = false;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json_array", nullable=false)
     */
    private $roles = [];

	/**
	 * @var DateTime
	 *
	 * @Assert\DateTime
	 * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $createdOn;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $createdBy = 1;		

	/**
	 * @var DateTime
	 *
	 * @Assert\DateTime
	 * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $modifiedOn;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $modifiedBy = 1;

	/**
	 * @var DateTime
	 *
	 * @Assert\DateTime
	 * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $lockedOn;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $lockedBy = 1;

    /**
     * @var DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="last_visit_date", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lastVisitDate;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_code", type="string", nullable=false, options={"default"="0"})
     */
    private $activationCode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="text", nullable=false, options={"default"="en"})
     */
    private $locale = 'en';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false, options={"default"="params"})
     */
    private $params = 'params';

    /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="last_reset_time", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP", "comment"="Date of last password reset"})
     */
    private $lastResetTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="reset_count", type="integer", nullable=false, options={"default" : 0, "comment"="Count of password resets since lastResetTime"})
     */
    private $resetCount = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="otp_key", type="string", nullable=false, options={"default"="","comment"="Two factor authentication encrypted keys"})
     */
    private $otpKey = '';

    /**
     * @var string
     *
     * @ORM\Column(name="otep", type="string", nullable=false, options={"default"="","comment"="One time emergency passwords"})
     */
    private $otep = '';

    /**
     * @var boolean/false
     *
     * @ORM\Column(name="require_reset", type="boolean", nullable=false, options={"default" : 0, "comment"="Require user to reset password on next login"})
     */
    private $requireReset = 0;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="vendor_slug", type="string", nullable=true, options={"default"="vendor_slug"})
	 * @Assert\NotBlank(message="vendor_slug.blank_content")
	 * @Assert\Length(min=6, minMessage="vendor_slug.too_short_content")
	 */
    private $vendorSlug;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsSecurity", cascade={"persist", "remove"}, mappedBy="vendorSecurity")
     * @Assert\Type(type="App\Entity\Vendor\VendorsSecurity")
     * @Assert\Valid()
     */
    private $vendorSecurity;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsIban", cascade={"persist", "remove"}, mappedBy="vendorIban")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsSecurity")
	 * @Assert\Valid()
	 */
	private $vendorIban;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsEnGb", cascade={"persist", "remove"}, mappedBy="vendorEnGb")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsEnGb")
	 * @Assert\Valid()
     */
    private $vendorEnGb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorsDocAttachments", cascade={"persist", "remove"}, mappedBy="vendorDocAttachments")
     */
    private $vendorDocAttachments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorsMediaAttachments", cascade={"persist", "remove"}, mappedBy="vendorMediaAttachments")
     */
    private $vendorMediaAttachments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order\Orders", cascade={"persist"}, mappedBy="vendorOrders")
     */
    private $vendorOrders;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrdersItems", mappedBy="vendorOrderItems")
	 */
    private $vendorOrderItems;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\VendorsFavourites", mappedBy="vendorFavourites")
	 * @ORM\JoinTable(name="products_tags")
	 * @ORM\OrderBy({"name": "ASC"})
	 * @Assert\Count(max="4", maxMessage="products.too_many_tags")
	 */
    private $vendorFavourites;








    /**
     * Vendors constructor.
     */
    public function __construct()
    {
		$this->createdOn = new DateTime();
		$this->modifiedOn = new DateTime();
		$this->lockedOn = new DateTime();
        $this->lastResetTime = new DateTime();
        $this->lastVisitDate = new DateTime();
        $this->vendorOrders = new ArrayCollection();
        $this->vendorDocAttachments = new ArrayCollection();
        $this->vendorMediaAttachments = new ArrayCollection();
    }

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return bool|false
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * @param bool|false $active
	 */
	public function setActive($active): void
	{
		$this->active = $active;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedOn(): DateTime
	{
		return $this->createdOn;
	}

	/**
	 * @ORM\PrePersist
	 * @throws Exception
	 */
	public function setCreatedOn(): void
	{
		$this->createdOn = new DateTime();
	}

	/**
	 * @return integer
	 */
	public function getCreatedBy(): int
	{
		return $this->createdBy;
	}

	/**
	 * @param integer $createdBy
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
	 * @ORM\PreFlush
	 * @ORM\PreUpdate
	 * @throws Exception
	 */
	public function setModifiedOn(): void
	{
		$this->modifiedOn = new DateTime();
	}

	/**
	 * @return integer
	 */
	public function getModifiedBy(): int
	{
		return $this->modifiedBy;
	}

	/**
	 * @param integer $modifiedBy
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
	 * @param datetime $lockedOn
	 */
	public function setLockedOn(DateTime $lockedOn): void
	{
		$this->lockedOn = $lockedOn;
	}

	/**
	 * @return integer
	 */
	public function getLockedBy(): int
	{
		return $this->lockedBy;
	}

	/**
	 * @param integer $lockedBy
	 */
	public function setLockedBy(int $lockedBy): void
	{
		$this->lockedBy = $lockedBy;
	}

	/**
     * @return DateTime
     */
    public function getLastVisitDate(): DateTime
    {
        return $this->lastVisitDate;
    }

    /**
     * @param DateTime $lastVisitDate
     * @return Vendors
     */
    public function setLastVisitDate(DateTime $lastVisitDate): self
    {
        $this->lastVisitDate = $lastVisitDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    /**
     * @param string $activationCode
     * @return Vendors
     */
    public function setActivationCode(string $activationCode): self
    {
        $this->activationCode = $activationCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getParams(): string 
    {
        return $this->params;
    }

    /**
     * @param string $params
     * @return Vendors
     */
    public function setParams(string $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastResetTime(): DateTime
    {
        return $this->lastResetTime;
    }

    /**
     * @param DateTime $lastResetTime
     * @return Vendors
     */
    public function setLastResetTime(DateTime $lastResetTime): self
    {
        $this->lastResetTime = $lastResetTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getResetCount(): int
    {
        return $this->resetCount;
    }

    /**
     * @param int $resetCount
     * @return Vendors
     */
    public function setResetCount(int $resetCount): self
    {
        $this->resetCount = $resetCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtpKey(): string
    {
        return $this->otpKey;
    }

    /**
     * @param string $otpKey
     * @return Vendors
     */
    public function setOtpKey(string $otpKey): self
    {
        $this->otpKey = $otpKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtep(): string
    {
        return $this->otep;
    }

    /**
     * @param string $otep
     * @return Vendors
     */
    public function setOtep(string $otep): self
    {
        $this->otep = $otep;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequireReset(): bool
    {
        return $this->requireReset;
    }

    /**
     * @param bool $requireReset
     * @return Vendors
     */
    public function setRequireReset(bool $requireReset): self
    {
        $this->requireReset = $requireReset;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return [
            'ROLE_USER'
        ];
    }

	/**
	 * @return string|null
	 */
	public function getVendorSlug(): ?string
	{
		return $this->vendorSlug;
	}

	/**
	 * @param string|null $vendorSlug
	 */
	public function setVendorSlug(?string $vendorSlug): void
	{
		$this->vendorSlug = $vendorSlug;
	}



    /**
     * @return mixed
     */
    public function getVendorSecurity()
    {
        return $this->vendorSecurity;
    }

    /**
     * @param mixed $vendorSecurity
     */
    public function setVendorSecurity($vendorSecurity): void
    {
        $this->vendorSecurity = $vendorSecurity;
    }



    /**
     * @return mixed
     */
    public function getVendorEnGb()
    {
        return $this->vendorEnGb;
    }

    /**
     * @param mixed $vendorEnGb
     */
    public function setVendorEnGb($vendorEnGb): void
    {
        $this->vendorEnGb = $vendorEnGb;
    }

    /**
     * @param Orders $order
     * @return Vendors
     */
    public function addOrder(Orders $order): Vendors
    {
        $this->vendorOrders[] = $order;

        return $this;
    }

    /**
     * @param Orders $order
     */
    public function removeOrder(Orders $order)
    {
        $this->vendorOrders->removeElement($order);
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->vendorOrders;
    }

	/**
	 * @param VendorsDocAttachments $vendorDocAttachment
	 *
	 * @return Vendors
	 */
    public function addVendorDocAttachment(VendorsDocAttachments $vendorDocAttachment): Vendors
    {
        $this->vendorDocAttachments[] = $vendorDocAttachment;

        return $this;
    }

	/**
	 * @param VendorsDocAttachments $vendorDocAttachment
	 */
    public function removeVendorDocAttachment(VendorsDocAttachments $vendorDocAttachment)
    {
        $this->vendorDocAttachments->removeElement($vendorDocAttachment);
    }

    /**
     * @return mixed
     */
    public function getVendorDocAttachments()
    {
        return $this->vendorDocAttachments;
    }

	/**
	 * @param VendorsMediaAttachments $vendorMediaAttachment
	 *
	 * @return Vendors
	 */
    public function addVendorMediaAttachment(VendorsMediaAttachments $vendorMediaAttachment): Vendors
    {
        $this->vendorMediaAttachments[] = $vendorMediaAttachment;

        return $this;
    }

	/**
	 * @param VendorsMediaAttachments $vendorMediaAttachment
	 */
    public function removeVendorMediaAttachment(VendorsMediaAttachments $vendorMediaAttachment)
    {
        $this->vendorMediaAttachments->removeElement($vendorMediaAttachment);
    }

    /**
     * @return mixed
     */
    public function getVendorMediaAttachments()
    {
        return $this->vendorMediaAttachments;
    }

	/**
	 * @return mixed
	 */
	public function getVendorIban()
	{
		return $this->vendorIban;
	}

	/**
	 * @param mixed $vendorIban
	 */
	public function setVendorIban($vendorIban): void
	{
		$this->vendorIban = $vendorIban;
	}

	/**
	 * @return mixed
	 */
	public function getVendorOrders()
	{
		return $this->vendorOrders;
	}

	/**
	 * @param mixed $vendorOrders
	 */
	public function setVendorOrders($vendorOrders): void
	{
		$this->vendorOrders = $vendorOrders;
	}

	/**
	 * @return mixed
	 */
	public function getVendorFavourites()
	{
		return $this->vendorFavourites;
	}

	/**
	 * @param mixed $vendorFavourites
	 */
	public function setVendorFavourites($vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
	}

	/**
	 * @return mixed
	 */
	public function getVendorOrderItems()
	{
		return $this->vendorOrderItems;
	}

	public function setRoles()
	{
	}
}

