<?php

namespace App\Entity\Vendor;


use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use App\Controller\Vendor\VendorController;
use App\Entity\BaseTrait;
use App\Entity\Commission\Commission;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\Order\OrderItem;
use App\Entity\Product\Product;
use App\Entity\Shipment\Shipment;
use App\Interface\Vendor\VendorInterface;
use App\Repository\Vendor\VendorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Order\OrderStorage;
use Exception;

#[ORM\Table(
    name: 'vendor',

)]
#[ORM\Index(columns: ['slug'], name: 'vendor_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['vendor:list']],
            name: 'vendor_list'
        ),
        new Get(
            normalizationContext: ['groups' => ['vendor:item']],
            name: 'vendor_item'
        ),
        new Put(
            denormalizationContext: ['groups' => ['write','vendorEn','vendorSecurity','vendorIban']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/vendor/{slug}',
            controller: VendorController::class,
            normalizationContext: ['groups' => ['vendor:item']],
            name: 'vendor_by_slug'
        )
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']]
)]
# Boolean filter по активности и публикации
#[ApiFilter(BooleanFilter::class, properties: ['isActive', 'published'])]
# Поиск по полям
#[ApiFilter(SearchFilter::class, properties: [
    'slug' => 'exact',
    'locale' => 'exact',
    'vendorEnGb.firstTitle' => 'partial',
    'vendorEnGb.lastTitle' => 'partial'
])]
# Сортировка
#[ApiFilter(OrderFilter::class, properties: ['createdAt','modifiedAt','slug','isActive'], arguments: ['orderParameterName' => 'order'])]
class Vendor implements VendorInterface, \JsonSerializable
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;


    #[Groups(['vendor:list', 'vendor:item'])]
    #[ORM\Column(name: 'is_active', type: 'boolean', nullable: false, options: ['default' => 1, 'comment' => 'New user default is active'])]
    private bool $isActive = true;

    #[Groups(['vendor:list', 'vendor:item'])]
    #[ORM\Column(name: 'locale', type: 'string', nullable: false, options: ['default' => 'en'])]
    private string $locale = 'en';

    #[ORM\Column(name: 'reset_count', type: 'integer', nullable: true, options: ['default' => 0, 'comment' => 'Count of password resets since lastResetTime'])]
    private ?int $resetCount = null;

    #[ORM\Column(name: 'otp_key', type: 'string', nullable: true, options: ['comment' => 'Two factor authentication encrypted keys'])]
    private ?string $otpKey = null;

    #[ORM\Column(name: 'otep', type: 'string', nullable: true, options: ['comment' => 'One time emergency passwords'])]
    private ?string $otep = null;

    #[ORM\Column(name: 'require_reset', type: 'boolean', nullable: false, options: ['default' => 0, 'comment' => 'Require user to reset password on next login'])]
    private bool $requireReset = false;

    #[ORM\OneToOne(mappedBy: 'vendorSecurity', targetEntity: VendorSecurity::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: VendorSecurity::class)]
    #[Assert\Valid]
    #[Ignore]
    private ?VendorSecurity $vendorSecurity = null;

    #[ORM\OneToOne(mappedBy: 'vendorIbanVendor', targetEntity: VendorIban::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: VendorIban::class)]
    #[Assert\Valid]
    #[Ignore]
    private ?VendorIban $vendorIban = null;

    #[ORM\OneToOne(mappedBy: 'vendorEnGbVendor', targetEntity: VendorEnUS::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: VendorEnUS::class)]
    #[Assert\Valid]
    #[Ignore]
    private ?VendorEnUS $vendorEnGb = null;

    #[ORM\OneToOne(mappedBy: 'vendorFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: Featured::class)]
    #[Assert\Valid]
    #[Ignore]
    private ?Featured $vendorFeatured = null;

    #[ORM\OneToMany(mappedBy: 'vendorDocumentVendor', targetEntity: VendorDocument::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $vendorDocument;

    #[ORM\OneToMany(mappedBy: 'vendorMediaVendor', targetEntity: VendorMedia::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorMedia;

    #[ORM\OneToMany(mappedBy: 'orderVendor', targetEntity: OrderStorage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorOrder;

    #[ORM\OneToMany(mappedBy: 'orderItemsVendor', targetEntity: OrderItem::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorItem;

    #[ORM\ManyToMany(targetEntity: VendorFavourite::class, mappedBy: 'vendorFavourite')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorFavourite;

    #[ORM\ManyToMany(targetEntity: VendorConversation::class, mappedBy: 'vendorConversationVendor')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorConversation;

    #[ORM\OneToMany(mappedBy: 'vendorMessage', targetEntity: VendorMessage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorMessage;

    #[ORM\ManyToMany(targetEntity: Vendor::class, mappedBy: 'vendorMyFriend')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorFriend;

    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorFriend')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorMyFriend;

    #[ORM\OneToMany(
        mappedBy: 'vendorProduct',
        targetEntity: Product::class,
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $vendorProduct;

    #[ORM\OneToMany(
        mappedBy: 'vendorCommission',
        targetEntity: Commission::class,
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $vendorCommission;

    #[ORM\OneToMany(
        mappedBy: 'vendorShipment',
        targetEntity: Shipment::class,
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $vendorShipment;



    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->vendorMessage = new ArrayCollection();
        $this->vendorItem = new ArrayCollection();
        $this->vendorOrder = new ArrayCollection();
        $this->vendorDocument = new ArrayCollection();
        $this->vendorMedia = new ArrayCollection();
        $this->vendorFriend = new ArrayCollection();
        $this->vendorMyFriend = new ArrayCollection();
        $this->isActive = true;
        $this->vendorProduct = new ArrayCollection();
        $this->vendorCommission = new ArrayCollection();
        $this->vendorShipment = new ArrayCollection();

        $this->lastRequestAt = clone $t;
        $this->createdAt = clone $t;
        $this->modifiedAt = clone $t;
        $this->lockedAt = clone $t;
        $this->published = true;
    }
    #
    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setIsActive(bool $isActive = false): void
    {
        $this->isActive = $isActive;
    }
    #
    public function getLocale(): ?string
    {
        return $this->locale;
    }
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
    #
    public function getResetCount(): ?int
    {
        return $this->resetCount;
    }
    public function setResetCount(int $resetCount): self
    {
        $this->resetCount = $resetCount;
        return $this;
    }
    #
    public function getOtpKey(): ?string
    {
        return $this->otpKey;
    }
    public function setOtpKey(string $otpKey): self
    {
        $this->otpKey = $otpKey;
        return $this;
    }
    #
    public function getOtep(): ?string
    {
        return $this->otep;
    }
    public function setOtep(string $otep): self
    {
        $this->otep = $otep;
        return $this;
    }
    #
    public function isRequireReset(): bool
    {
        return $this->requireReset;
    }
    public function setRequireReset(bool $requireReset): self
    {
        $this->requireReset = $requireReset;
        return $this;
    }

    # OneToOne
    public function getVendorSecurity(): ?VendorSecurity
    {
        return $this->vendorSecurity;
    }
    public function setVendorSecurity(VendorSecurity $vendorSecurity): void
    {
        $this->vendorSecurity = $vendorSecurity;
    }
    # OneToOne
    public function getVendorEnGb(): VendorEnUS
    {
        return $this->vendorEnGb;
    }
    public function setVendorEnGb(VendorEnUS $vendorEnGb): void
    {
        $this->vendorEnGb = $vendorEnGb;
    }
    # OneToMany
    /** @return Collection<int, Commission> */
    public function getVendorCommission(): Collection
    {
        return $this->vendorCommission;
    }
    public function addVendorCommission(Commission $commission): void
    {
        if (!$this->vendorCommission->contains($commission)) {
            $this->vendorCommission->add($commission);
            $commission->setVendor($this);
        }
    }
    public function removeVendorCommission(Commission $commission): void
    {
        if ($this->vendorCommission->removeElement($commission)) {
            if ($commission->getVendor() === $this) {
                $commission->setVendor(null);
            }
        }
    }
    # OneToMany
    /** @return Collection<int, Product> */
    public function getVendorProduct(): Collection
    {
        return $this->vendorProduct;
    }
    public function addVendorProduct(Product $product): void
    {
        if (!$this->vendorProduct->contains($product)) {
            $this->vendorProduct->add($product);
            $product->setVendor($this);
        }
    }
    public function removeVendorProduct(Product $product): void
    {
        if ($this->vendorProduct->removeElement($product)) {
            if ($product->getVendor() === $this) {
                $product->setVendor(null);
            }
        }
    }
    # OneToMany
    /** @return Collection<int, Shipment> */
    public function getShipment(): Collection
    {
        return $this->vendorShipment;
    }
    public function addVendorShipment(Shipment $shipment): void
    {
        if (!$this->vendorShipment->contains($shipment)) {
            $this->vendorShipment->add($shipment);
            $shipment->setVendor($this);
        }
    }
    public function removeVendorShipment(Shipment $shipment): void
    {
        if ($this->vendorShipment->removeElement($shipment)) {
            if ($shipment->getVendor() === $this) {
                $shipment->setVendor(null);
            }
        }
    }
    # OneToMany
    /** @return Collection<int, VendorDocument> */
    public function getVendorDocument(): Collection
    {
        return $this->vendorDocument;
    }
    public function addVendorDocument(VendorDocument $vendorDocument): self
    {
        $this->vendorDocument[] = $vendorDocument;

        return $this;
    }
    public function removeVendorDocument(VendorDocument $vendorDocument): self
    {
        if ($this->vendorDocument->contains($vendorDocument)){
            $this->vendorDocument->removeElement($vendorDocument);
        }
        return $this;
    }
    # OneToMany
    public function getVendorMedia(): Collection
    {
        return $this->vendorMedia;
    }
    public function addVendorMedia(VendorMedia $vendorMedia): self
    {
        if (!$this->vendorMedia->contains($vendorMedia)){
            $this->vendorMedia[] = $vendorMedia;

        }
        return $this;
    }
    public function removeVendorMedia(VendorMedia $vendorMedia): self
    {
        if ($this->vendorMedia->contains($vendorMedia)){
            $this->vendorMedia->removeElement($vendorMedia);
        }
        return $this;
    }
    # OneToOne
    public function getVendorIban(): VendorIban
    {
        return $this->vendorIban;
    }
    public function setVendorIban(VendorIban $vendorIban): void
    {
        $this->vendorIban = $vendorIban;
    }
    # OneToMany
    public function getVendorOrder(): ArrayCollection
    {
        return $this->vendorOrder;
    }
    public function addVendorOrder(OrderStorage $vendorOrder): self
    {
        if (!$this->vendorOrder->contains($vendorOrder)){
            $this->vendorOrder[] = $vendorOrder;
        }
        return $this;
    }
    public function removeVendorOrder(OrderStorage $vendorOrder): self
    {
        if ($this->vendorOrder->contains($vendorOrder)){
            $this->vendorOrder->removeElement($vendorOrder);
        }
        return $this;
    }
    # ManyToMany
    public function getVendorFavourite(): Collection
    {
        return $this->vendorFavourite;
    }
    public function addVendorFavourite(VendorFavourite $vendorFavourite): self
    {
        if (!$this->vendorFavourite->contains($vendorFavourite)){
            $this->vendorFavourite[] = $vendorFavourite;
        }
        return $this;
    }
    public function removeVendorFavourite(VendorFavourite $vendorFavourite): self
    {
        if ($this->vendorFavourite->contains($vendorFavourite)){
            $this->vendorFavourite->removeElement($vendorFavourite);
        }
        return $this;
    }
    # OneToOne
    public function getVendorFeatured(): Featured
    {
        return $this->vendorFeatured;
    }
    public function setVendorFeatured(Featured $vendorFeatured): void
    {
        $this->vendorFeatured = $vendorFeatured;
    }
    # OneToMany
    public function getVendorItem(): Collection
    {
        return $this->vendorItem;
    }
    public function addVendorItem(OrderItem $vendorItem): self
    {
        if (!$this->vendorItem->contains($vendorItem)){
            $this->vendorItem[] = $vendorItem;
        }
        return $this;
    }
    public function removeVendorItem(OrderItem $vendorItem): self
    {
        if ($this->vendorItem->contains($vendorItem)){
            $this->vendorItem->removeElement($vendorItem);
        }
        return $this;
    }
    # OneToMany
    public function getVendorMessage(): Collection
    {
     return $this->vendorMessage;
    }
    public function addVendorMessage(VendorMessage $vendorMessage): self
    {
        if (!$this->vendorMessage->contains($vendorMessage)){
            $this->vendorMessage[] = $vendorMessage;
        }
        return $this;
    }
    public function removeVendorMessage(VendorMessage $vendorMessage): self
    {
        if ($this->vendorMessage->contains($vendorMessage)){
            $this->vendorMessage->removeElement($vendorMessage);
        }
        return $this;
    }

    #[ArrayShape(["firstTitle" => "string", "lastTitle" => "string"])]
    public function jsonSerialize(): array
    {
        return [
            "firstTitle" => $this->getFirstTitle(),
            "lastTitle" => $this->getLastTitle()
        ];
    }
}

