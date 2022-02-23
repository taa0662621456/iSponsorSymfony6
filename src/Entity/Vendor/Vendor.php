<?php


namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\Message\Message;
use App\Entity\Message\MessageParticipant;
use App\Entity\Order\OrderItem;
use App\Repository\Vendor\VendorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Order\Order;
use Exception;
use DateTime;



/**
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="vendor:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="vendor:item"}}},
 *     order={"is_active"="DESC", "locale"="ASC"},
 *     paginationEnabled=false
 *     )
 * @ApiFilter(BooleanFilter::class, properties={"isActive"})
 */
#[ORM\Table(name: 'vendors')]
#[ORM\Index(columns: ['slug'], name: 'vendor_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Vendor
{
	use BaseTrait;

	#[Groups(['vendor:list', 'vendor:item'])]
	#[ORM\Column(name: 'is_active', type: 'boolean', nullable: false, options: ['default' => 1, 'comment' => 'New user default is active'])]
	private int|bool $isActive = true;

	#[Groups(['vendor:list', 'vendor:item'])]
	#[ORM\Column(name: 'locale', type: 'string', nullable: true, options: ['default' => 'en'])]
	private ?string $locale = 'en';

	#[ORM\Column(name: 'reset_count', type: 'integer', nullable: true, options: ['default' => 0, 'comment' => 'Count of password resets since lastResetTime'])]
	private ?int $resetCount = 0;

	#[ORM\Column(name: 'otp_key', type: 'string', nullable: false, options: ['default' => '', 'comment' => 'Two factor authentication encrypted keys'])]
	private string $otpKey = '';

	#[ORM\Column(name: 'otep', type: 'string', nullable: false, options: ['default' => '', 'comment' => 'One time emergency passwords'])]
	private string $otep = '';

	#[ORM\Column(name: 'require_reset', type: 'boolean', nullable: false, options: ['default' => 0, 'comment' => 'Require user to reset password on next login'])]
	private int|bool $requireReset = false;

	#[ORM\OneToOne(mappedBy: 'vendorSecurity', targetEntity: VendorSecurity::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
	#[ORM\JoinColumn(name: 'vendorSecurity_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	#[Assert\Type(type: VendorSecurity::class)]
	#[Assert\Valid]
	private array|VendorSecurity $vendorSecurity;

	#[ORM\OneToOne(mappedBy: 'vendorIban', targetEntity: VendorIban::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
	#[ORM\JoinColumn(name: 'vendorIban_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	#[Assert\Type(type: VendorIban::class)]
	#[Assert\Valid]
	private array|VendorIban $vendorIban;

	#[ORM\OneToOne(mappedBy: 'vendorEnGb', targetEntity: VendorEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
	#[ORM\JoinColumn(name: 'vendorEnGb_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	#[Assert\Type(type: VendorEnGb::class)]
	#[Assert\Valid]
	private array|VendorEnGb $vendorEnGb;

	#[ORM\OneToOne(mappedBy: 'vendorFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
	#[ORM\JoinColumn(name: 'vendorFeatured_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	#[Assert\Type(type: Featured::class)]
	#[Assert\Valid]
	private array|Featured $vendorFeatured;

	#[ORM\OneToMany(mappedBy: 'attachments', targetEntity: VendorDocument::class, cascade: ['persist', 'remove'])]
	#[ORM\JoinTable(name: 'attachments')]
	private Collection $vendorDocumentAttachments;

	#[ORM\OneToMany(mappedBy: 'attachments', targetEntity: VendorMedia::class, cascade: ['persist', 'remove'])]
	#[ORM\JoinTable(name: 'attachments')]
	private Collection $vendorMediaAttachments;

	#[ORM\OneToMany(mappedBy: 'orderCreatedAt', targetEntity: Order::class)]
	#[ORM\JoinTable(name: 'orders')]
	private Collection $vendorOrders;

	#[ORM\OneToMany(mappedBy: 'itemVendors', targetEntity: OrderItem::class)]
	#[ORM\JoinTable(name: 'ordersItems')]
	private Collection $vendorItems;

	#[ORM\OneToMany(mappedBy: 'vendor', targetEntity: Message::class)]
	#[ORM\JoinTable(name: 'vendorsMessage')]
	private Collection $vendorMessage;

	#[ORM\OneToMany(mappedBy: 'vendor', targetEntity: MessageParticipant::class)]
	#[ORM\JoinTable(name: 'participant')]
	private Collection $participant;

	#[ORM\ManyToMany(targetEntity: VendorFavourite::class, mappedBy: 'vendorFavourites')]
	#[ORM\JoinColumn(name: 'vendors_favourite_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	private Collection $vendorFavourite;
	/**
	 * @throws Exception
	 */
	public function __construct()
 {
     $t = new DateTime();
     $this->slug = (string)Uuid::v4();

     $this->lastRequestDate = $t->format('Y-m-d H:i:s');
     $this->participant = new ArrayCollection();
     $this->vendorMessage = new ArrayCollection();
     $this->vendorItems = new ArrayCollection();
     $this->vendorOrders = new ArrayCollection();
     $this->vendorDocumentAttachments = new ArrayCollection();
     $this->vendorMediaAttachments = new ArrayCollection();
     $this->isActive = true;

 }
	public function isActive(): bool
    {
		return $this->isActive;
	}
	public function setIsActive(bool $isActive = false): void
	{
		$this->isActive = $isActive;
	}
	public function getLocale(): ?string
	{
		return $this->locale;
	}
	public function setLocale(string $locale): void
	{
		$this->locale = $locale;
	}
	public function getResetCount(): int
	{
		return $this->resetCount;
	}
	public function setResetCount(int $resetCount): self
	{
		$this->resetCount = $resetCount;
		return $this;
	}
	public function getOtpKey(): string
	{
		return $this->otpKey;
	}
	public function setOtpKey(string $otpKey): self
	{
		$this->otpKey = $otpKey;
		return $this;
	}
	public function getOtep(): string
	{
		return $this->otep;
	}
	public function setOtep(string $otep): self
	{
		$this->otep = $otep;
		return $this;
	}
	public function isRequireReset(): bool
	{
		return $this->requireReset;
	}
	public function setRequireReset(bool $requireReset): self
	{
		$this->requireReset = $requireReset;
		return $this;
	}
	public function getVendorSecurity(): VendorSecurity
    {
		return $this->vendorSecurity;
	}
	public function setVendorSecurity(VendorSecurity $vendorSecurity): void
	{
		$this->vendorSecurity = $vendorSecurity;
	}
	public function getVendorEnGb(): VendorEnGb
    {
		return $this->vendorEnGb;
	}
	public function setVendorEnGb(VendorEnGb $vendorEnGb): void
	{
		$this->vendorEnGb = $vendorEnGb;
	}
    public function getOrders(): ArrayCollection
    {
        return $this->vendorOrders;
    }
    public function addOrder(Order $order): Vendor
	{
		$this->vendorOrders[] = $order;

		return $this;
	}
    public function removeOrder(Order $order)
	{
		$this->vendorOrders->removeElement($order);
	}
    public function getVendorDocumentAttachments(): ArrayCollection
    {
        return $this->vendorDocumentAttachments;
    }
    public function addVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment): Vendor
	{
		$this->vendorDocumentAttachments[] = $vendorDocumentAttachment;

		return $this;
	}
    public function removeVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment)
	{
		$this->vendorDocumentAttachments->removeElement($vendorDocumentAttachment);
	}
    public function getVendorMediaAttachments(): ArrayCollection
    {
        return $this->vendorMediaAttachments;
    }
    public function addVendorMediaAttachment(VendorMedia $vendorMediaAttachment): Vendor
	{
		$this->vendorMediaAttachments[] = $vendorMediaAttachment;

		return $this;
	}
    public function removeVendorMediaAttachment(VendorMedia $vendorMediaAttachment)
	{
		$this->vendorMediaAttachments->removeElement($vendorMediaAttachment);
	}
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

