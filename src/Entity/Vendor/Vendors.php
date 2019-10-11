<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Entity\Order\Orders;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="vendors", indexes={
 * @ORM\Index(name="vendor_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorsRepository")
 * @UniqueEntity("slug"), errorPath="slug", message="This name is already in use."
 * @ORM\HasLifecycleCallbacks()
 */
class Vendors
{
	use BaseTrait;

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
	 * @var datetime
	 *
	 * @Assert\DateTime()
	 * @ORM\Column(name="last_reset_time", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP",
	 *                                     "comment"="Date of last password reset"})
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
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsEnGb",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="vendorEnGb", orphanRemoval=true)
	 * @ORM\JoinColumn(name="vendorEnGb_id", referencedColumnName="id", onDelete="CASCADE")
	 * @Assert\Type(type="App\Entity\Vendor\VendorsEnGb")
	 * @Assert\Valid()
	 */
	private $vendorEnGb;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorsDocumentAttachments",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
	 */
	private $vendorDocumentAttachments;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Vendor\VendorsMediaAttachments",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="attachments")
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
	 * @var int
	 *
	 * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\VendorsFavourites", mappedBy="vendorFavourites")
	 * @ORM\JoinTable(name="vendors_favourites")
	 * @ORM\OrderBy({"name": "ASC"})
	 */
	private $vendorFavourites;


	/**
	 * Vendors constructor.
	 */
	public function __construct()
	{
		$this->lastResetTime = new DateTime();
		$this->lastVisitDate = new DateTime();
		$this->vendorOrders = new ArrayCollection();
		$this->vendorDocumentAttachments = new ArrayCollection();
		$this->vendorMediaAttachments = new ArrayCollection();
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
	public function getLastVisitDate(): DateTime
	{
		return $this->lastVisitDate;
	}

	/**
	 * @param DateTime $lastVisitDate
	 *
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
	 *
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
	 * @return DateTime
	 */
	public function getLastResetTime(): DateTime
	{
		return $this->lastResetTime;
	}

	/**
	 * @param DateTime $lastResetTime
	 *
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
	 *
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
	 *
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
	 *
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
	 *
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
	 * @param VendorsEnGb $vendorEnGb
	 */
	public function setVendorEnGb(VendorsEnGb $vendorEnGb): void
	{
		$this->vendorEnGb = $vendorEnGb;
	}

	/**
	 * @param Orders $order
	 *
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
	 * @param VendorsDocumentAttachments $vendorDocumentAttachment
	 *
	 * @return Vendors
	 */
	public function addVendorDocumentAttachment(VendorsDocumentAttachments $vendorDocumentAttachment): Vendors
	{
		$this->vendorDocumentAttachments[] = $vendorDocumentAttachment;

		return $this;
	}

	/**
	 * @param VendorsDocumentAttachments $vendorDocumentAttachment
	 */
	public function removeVendorDocumentAttachment(VendorsDocumentAttachments $vendorDocumentAttachment)
	{
		$this->vendorDocumentAttachments->removeElement($vendorDocumentAttachment);
	}

	/**
	 * @return mixed
	 */
	public function getVendorDocumentAttachments()
	{
		return $this->vendorDocumentAttachments;
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
	public function getVendorOrderItems()
	{
		return $this->vendorOrderItems;
	}

	public function setRoles()
	{
	}
}

