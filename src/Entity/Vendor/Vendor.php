<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Order\Order;
use Exception;
use DateTime;



/**
 * @ORM\Table(name="vendors", indexes={
 * @ORM\Index(name="vendor_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This name | {Value} | is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="vendor:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="vendor:item"}}},
 *     order={"roles"="DESC", "last_reset_time"="ASC"},
 *     paginationEnabled=false
 *     )
 * @ApiFilter(BooleanFilter::class, properties={"isActive"})
 */
class Vendor
{
	use BaseTrait;

	/**
	 * @var true
	 *
	 * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default" : 1})
	 */
    #[Groups(['vendor:list', 'vendor:item'])]
	private bool $isActive;

	/**
	 * @var array
	 *
	 * @ORM\Column(name="roles", type="json", nullable=false)
	 */
    #[Groups(['vendor:list', 'vendor:item'])]
	private array $roles = ["ROLE_USER"];

	/**
     * @var string
     *
	 * @ORM\Column(name="last_visit_date", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
    #[Groups(['vendor:list', 'vendor:item'])]
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
    #[Groups(['vendor:list', 'vendor:item'])]
	private ?string $locale = null;

	/**
	 * @var string
     *
	 * @ORM\Column(name="last_reset_time", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP",
	 *                                     "comment"="Date of last password reset"})
	 */
    #[Groups(['vendor:list', 'vendor:item'])]
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
	 * @var int|boolean
	 *
	 * @ORM\Column(name="require_reset", type="boolean", nullable=false,
     *     options={"default" : 0, "comment"="Require user to reset password on next login"})
     */
	private int|bool $requireReset = 0;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorSecurity",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorSecurity", orphanRemoval=true)
	 * @ORM\JoinColumn(name="vendorSecurity_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     *
	 * @Assert\Type(type="App\Entity\Vendor\VendorSecurity")
	 * @Assert\Valid()
	 */
	private VendorSecurity $vendorSecurity;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorIban",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorIban", orphanRemoval=true)
     * @ORM\JoinColumn(name="vendorIban_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     *
     * @Assert\Type(type="App\Entity\Vendor\VendorIban")
	 * @Assert\Valid()
	 */
	private VendorIban $vendorIban;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorEnGb",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorEnGb", orphanRemoval=true)
	 * @ORM\JoinColumn(name="vendorEnGb_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     *
	 * @Assert\Type(type="App\Entity\Vendor\VendorEnGb")
	 * @Assert\Valid()
	 */
	private VendorEnGb $vendorEnGb;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured\Featured",
     *     cascade={"persist", "remove"},
     *     mappedBy="vendorFeatured", orphanRemoval=true)
     * @ORM\JoinColumn(name="vendorFeatured_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     *
     * @Assert\Type(type="App\Entity\Featured\Featured")
     * @Assert\Valid()
     */
    private Featured $vendorFeatured;

    /**
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorDocument",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
     * @ORM\JoinTable(name="attachments")
	 */
	private Collection $vendorDocumentAttachments;

    /**
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorMedia",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
     * @ORM\JoinTable(name="attachments")
	 */
	private Collection $vendorMediaAttachments;

    /**
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\Order",
	 *     mappedBy="orderCreatedAt")
	 * @ORM\JoinTable(name="orders")
	 */
	private Collection $vendorOrders;

    /**
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrderItem",
	 *     mappedBy="itemVendors")
	 * @ORM\JoinTable(name="ordersItems")
	 */
	private Collection $vendorItems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\Message",
     *     mappedBy="vendor")
     * @ORM\JoinTable(name="vendorsMessage")
     */
    private Collection $vendorMessage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\MessageParticipant",
     *     mappedBy="vendor")
     * @ORM\JoinTable(name="participant")
     */
    private Collection $participant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\VendorFavourite", mappedBy="vendorFavourite")
     * @ORM\JoinColumn(name="vendors_favourite_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private Collection $vendorFavourite;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new DateTime();
        $this->lastResetTime = $t->format('Y-m-d H:i:s');
        $this->lastVisitDate = $t->format('Y-m-d H:i:s');
        $this->participant = new ArrayCollection();
        $this->vendorMessage = new ArrayCollection();
        $this->vendorItems = new ArrayCollection();
        $this->vendorOrders = new ArrayCollection();
        $this->vendorDocumentAttachments = new ArrayCollection();
        $this->vendorMediaAttachments = new ArrayCollection();
        $this->isActive = true;

    }

    /**
     * @return bool
     */
	public function isActive(): bool
    {
		return $this->isActive;
	}

    /**
     * @param bool|false $isActive
     */
	public function setIsActive(bool $isActive): void
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
     * @param string $lastVisitDate
     * @return Vendor
     */
	public function setLastVisitDate (string $lastVisitDate): self
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
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
	}

    /**
     * @return VendorSecurity
     */
	public function getVendorSecurity(): VendorSecurity
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
     * @return VendorEnGb
     */
	public function getVendorEnGb(): VendorEnGb
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
		$this->vendorOrders[] = $order;

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
     * @return ArrayCollection
     */
	public function getVendorDocumentAttachments(): ArrayCollection
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
     * @return ArrayCollection
     */
	public function getVendorMediaAttachments(): ArrayCollection
    {
		return $this->vendorMediaAttachments;
	}

    /**
     * @return VendorIban
     */
	public function getVendorIban(): VendorIban
    {
		return $this->vendorIban;
	}

	/**
	 * @param $vendorIban
	 */
	public function setVendorIban($vendorIban): void
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
	 * @param $vendorOrders
	 */
	public function setVendorOrders($vendorOrders): void
	{
		$this->vendorOrders = $vendorOrders;
	}

    /**
     * @return Collection
     */
	public function getVendorFavourite(): Collection
    {
		return $this->vendorFavourite;
	}

	/**
	 * @param $vendorFavourite
	 */
	public function setVendorFavourite($vendorFavourite): void
	{
		$this->vendorFavourite = $vendorFavourite;
	}

    /**
     * @return Featured
     */
	public function getVendorFeatured(): Featured
    {
		return $this->vendorFeatured;
	}

	/**
	 * @param $vendorFeatured
	 */
	public function setVendorFeatured($vendorFeatured): void
	{
		$this->vendorFeatured = $vendorFeatured;
	}

    /**
     * @return ArrayCollection
     */
	public function getVendorItems(): ArrayCollection
    {
		return $this->vendorItems;
	}

	/**
	 * @param $vendorItems
     */
    public function setVendorItems($vendorItems): void
    {
        $this->vendorItems = $vendorItems;
    }

    /**
     * @return ArrayCollection
     */
    public function getVendorMessage(): ArrayCollection
    {
        return $this->vendorMessage;
    }

    /**
     * @param $vendorMessage
     */
    public function setVendorMessage($vendorMessage): void
    {
        $this->vendorMessage = $vendorMessage;
    }

    /**
     * @return ArrayCollection
     */
    public function getParticipant(): ArrayCollection
    {
        return $this->participant;
    }

    /**
     * @param $participant
     */
    public function setParticipant($participant): void
    {
        $this->participant = $participant;
    }


}

