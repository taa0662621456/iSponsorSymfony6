<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Order\Order;
use Exception;
use DateTime;



/**
 * @ORM\Table(name="vendors", indexes={
 * @ORM\Index(name="vendor_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This name is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Vendor
{
	use BaseTrait;

	/**
	 * @var bool|false
	 *
	 * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default" : 0})
	 */
	private bool $iaActive = false;

	/**
	 * @var array
	 *
	 * @ORM\Column(name="roles", type="json", nullable=false)
	 */
	private array $roles = [];

	/**
     * @var string
     *
	 * @ORM\Column(name="last_visit_date", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private string $lastVisitDate;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="activation_code", type="string", nullable=false, options={"default"="0"})
	 */
	private string $activationCode = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="locale", type="string", nullable=true, options={"default"="en"})
	 */
	private ?string $locale = null;

	/**
	 * @var string
     *
	 * @ORM\Column(name="last_reset_time", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP",
	 *                                     "comment"="Date of last password reset"})
	 */
	private string $lastResetTime;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="reset_count", type="integer", nullable=false, options={"default" : 0, "comment"="Count of password resets since lastResetTime"})
     */
	private int $resetCount = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="otp_key", type="string", nullable=false, options={"default"="","comment"="Two factor authentication encrypted keys"})
     */
	private string $otpKey = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="otep", type="string", nullable=false, options={"default"="","comment"="One time emergency passwords"})
     */
	private string $otep = '';

	/**
	 * @var boolean/false
	 *
	 * @ORM\Column(name="require_reset", type="boolean", nullable=false, options={"default" : 0, "comment"="Require user to reset password on next login"})
     */
	private int|bool $requireReset = 0;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorSecurity",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorSecurity")
	 * @ORM\JoinColumn(name="vendorSecurity_id", referencedColumnName="id", onDelete="CASCADE")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsSecurity")
	 * @Assert\Valid()
	 */
	private mixed $vendorSecurity;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorIban",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorIban")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsSecurity")
	 * @Assert\Valid()
	 */
	private mixed $vendorIban;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorEnGb",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorEnGb", orphanRemoval=true)
	 * @ORM\JoinColumn(name="vendorEnGb_id", referencedColumnName="id", onDelete="CASCADE")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsEnGb")
	 * @Assert\Valid()
	 */
	private mixed $vendorEnGb;

	/**
     *
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorDocument",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
	 */
	private $vendorDocumentAttachments;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorMedia",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
	 */
	private $vendorMediaAttachments;

	/**
     *
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\Order",
	 *     mappedBy="orderCreatedAt")
	 * @ORM\JoinTable(name="orders")
	 */
	private $vendorOrders;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrderItem",
	 *     mappedBy="itemVendors")
	 * @ORM\JoinTable(name="ordersItems")
	 */
	private mixed $vendorItems;

	/**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\VendorFavourite", mappedBy="vendorFavourites")
     * @ORM\JoinTable(name="vendors_favourites")
     */
    private int $vendorFavourites;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured", mappedBy="vendorFeatured")
     */
    private mixed $vendorFeatured;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\Message", mappedBy="vendor")
     */
    private mixed $vendorMessage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\MessageParticipant", mappedBy="vendor")
     */
    private mixed $participant;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new DateTime();
        $this->lastResetTime = $t->format('Y-m-d H:i:s');
        $this->lastVisitDate = $t->format('Y-m-d H:i:s');
        $this->vendorOrders = new ArrayCollection();
        $this->vendorDocumentAttachments = new ArrayCollection();
        $this->vendorMediaAttachments = new ArrayCollection();
        $this->iaActive = false;

    }

    /**
     * @return bool
     */
	public function getIsActive(): bool
    {
		return $this->iaActive;
	}

    /**
     * @param bool|false $isActive
     */
	public function setisActive(bool $isActive): void
	{
		$this->isActive = $isActive;
	}

	/**
	 * @return string
     */
	public function getLastVisitDate(): string
    {
        return $this->lastVisitDate;
	}

    /**
     * @param $lastVisitDate
     * @return Vendor
     */
	public function setLastVisitDate ($lastVisitDate): Vendor
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
	 *
	 * @return Vendor
	 */
	public function setActivationCode(string $activationCode): self
	{
		$this->activationCode = $activationCode;
		return $this;
	}

    /**
     * @return string|null
     */
	public function getLocale(): ?string
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
	public function getLastResetTime(): string
	{
		return $this->lastResetTime;
	}

    /**
     * @param string $lastResetTime
     *
     * @return Vendor
     */
	public function setLastResetTime(string $lastResetTime): Vendor
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
	 *
	 * @return Vendor
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
	 *
	 * @return Vendor
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
	 *
	 * @return Vendor
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
	 *
	 * @return Vendor
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
	 * @return mixed
	 */
	public function getVendorSecurity(): mixed
    {
		return $this->vendorSecurity;
	}

	/**
	 * @param VendorSecurity $vendorSecurity
	 */
	public function setVendorSecurity(VendorSecurity $vendorSecurity): void
	{
		$this->vendorSecurity = $vendorSecurity;
	}


	/**
	 * @return mixed
	 */
	public function getVendorEnGb(): mixed
    {
		return $this->vendorEnGb;
	}

	/**
	 * @param VendorEnGb $vendorEnGb
	 */
	public function setVendorEnGb(VendorEnGb $vendorEnGb): void
	{
		$this->vendorEnGb = $vendorEnGb;
	}

	/**
	 * @param Order $order
	 *
	 * @return Vendor
	 */
	public function addOrder(Order $order): Vendor
	{
		$this->vendorOrders = $order;

		return $this;
	}

	/**
	 * @param Order $order
	 */
	public function removeOrder(Order $order)
	{
		$this->vendorOrders->removeElement($order);
	}

	/**
	 * @return ArrayCollection
	 */
	public function getOrders(): ArrayCollection
	{
		return $this->vendorOrders;
	}

	/**
	 * @param VendorDocument $vendorDocumentAttachment
	 *
	 * @return Vendor
	 */
	public function addVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment): Vendor
	{
		$this->vendorDocumentAttachments[] = $vendorDocumentAttachment;

		return $this;
	}

	/**
	 * @param VendorDocument $vendorDocumentAttachment
	 */
	public function removeVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment)
	{
		$this->vendorDocumentAttachments->removeElement($vendorDocumentAttachment);
	}

	/**
	 * @return mixed
	 */
	public function getVendorDocumentAttachments(): mixed
    {
		return $this->vendorDocumentAttachments;
	}

	/**
	 * @param VendorMedia $vendorMediaAttachment
	 *
	 * @return Vendor
	 */
	public function addVendorMediaAttachment(VendorMedia $vendorMediaAttachment): Vendor
	{
		$this->vendorMediaAttachments[] = $vendorMediaAttachment;

		return $this;
	}

	/**
	 * @param VendorMedia $vendorMediaAttachment
	 */
	public function removeVendorMediaAttachment(VendorMedia $vendorMediaAttachment)
	{
		$this->vendorMediaAttachments->removeElement($vendorMediaAttachment);
	}

	/**
	 * @return mixed
	 */
	public function getVendorMediaAttachments(): mixed
    {
		return $this->vendorMediaAttachments;
	}

	/**
	 * @return mixed
	 */
	public function getVendorIban(): mixed
    {
		return $this->vendorIban;
	}

	/**
	 * @param mixed $vendorIban
	 */
	public function setVendorIban(mixed $vendorIban): void
	{
		$this->vendorIban = $vendorIban;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getVendorOrders(): ArrayCollection
    {
		return $this->vendorOrders;
	}

	/**
	 * @param mixed $vendorOrders
	 */
	public function setVendorOrders(mixed $vendorOrders): void
	{
		$this->vendorOrders = $vendorOrders;
	}

	/**
	 * @return int
	 */
	public function getVendorFavourites(): int
	{
		return $this->vendorFavourites;
	}

	/**
	 * @param int $vendorFavourites
	 */
	public function setVendorFavourites(int $vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
	}

	/**
	 * @return mixed
	 */
	public function getVendorFeatured(): mixed
    {
		return $this->vendorFeatured;
	}

	/**
	 * @param mixed $vendorFeatured
	 */
	public function setVendorFeatured(mixed $vendorFeatured): void
	{
		$this->vendorFeatured = $vendorFeatured;
	}

	/**
	 * @return mixed
	 */
	public function getVendorItems(): mixed
    {
		return $this->vendorItems;
	}

	/**
	 * @param mixed $vendorItems
     */
    public function setVendorItems(mixed $vendorItems): void
    {
        $this->vendorItems = $vendorItems;
    }


    public function setRoles()
    {
    }

    /**
     * @return mixed
     */
    public function getVendorMessage(): mixed
    {
        return $this->vendorMessage;
    }

    /**
     * @param mixed $vendorMessage
     */
    public function setVendorMessage(mixed $vendorMessage): void
    {
        $this->vendorMessage = $vendorMessage;
    }

    /**
     * @return mixed
     */
    public function getParticipant(): mixed
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     */
    public function setParticipant(mixed $participant): void
    {
        $this->participant = $participant;
    }


}

