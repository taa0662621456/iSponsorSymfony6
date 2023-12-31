<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use App\Entity\Order\OrderItem;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Entity\Order\OrderStorage;
use JetBrains\PhpStorm\ArrayShape;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\EntityInterface\Vendor\VendorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ApiResource(
    //    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'vendor:list']]],
    //    itemOperations: ['get' => ['normalization_context' => ['groups' => 'conference:item']], 'put', 'delete',
    //        'get_by_slug' => ['method' => 'GET', 'path' => 'vendor/{slug}', 'controller' => 'Vendor::class'], ],
    normalizationContext: ['groups' => 'read'],
    denormalizationContext: ['groups' => ['write', 'vendorEn', 'vendorSecurity', 'vendorIban']]
)]
#[ORM\Entity]
class Vendor extends RootEntity implements ObjectInterface, VendorInterface, \JsonSerializable
{
    #[Groups(['vendor:list', 'vendor:item'])]
    #[ORM\Column(name: 'is_active', type: 'boolean', nullable: false, options: ['default' => 1, 'comment' => 'New user default is active'])]
    private bool $isActive;

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
    private int|bool $requireReset = false;

    #[ORM\OneToOne(mappedBy: 'vendorSecurity', targetEntity: VendorSecurity::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private VendorSecurity $vendorSecurity;

    #[ORM\OneToOne(mappedBy: 'vendorIbanVendor', targetEntity: VendorIban::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private VendorIban $vendorIban;

    #[ORM\OneToOne(mappedBy: 'vendorEnUs', targetEntity: VendorEnUS::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private ?VendorEnUS $vendorEnUs = null;

    #[ORM\OneToOne(mappedBy: 'vendorEnGb', targetEntity: VendorEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private ?VendorEnUS $vendorEnGb = null;

    #[ORM\OneToOne(mappedBy: 'vendorShop', targetEntity: VendorShopUser::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private ?VendorShopUser $vendorShop = null;

    #[ORM\OneToOne(mappedBy: 'vendorFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private Featured $vendorFeatured;

    #[ORM\OneToMany(mappedBy: 'vendorDocumentVendor', targetEntity: VendorDocument::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
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

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'vendorMyFriend')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorFriend;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'vendorFriend')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorMyFriend;

    #[ORM\OneToOne(mappedBy: 'vendorProfile', targetEntity: VendorProfile::class)]
    private ?VendorProfile $vendorProfile = null;

    #[ORM\OneToOne(mappedBy: 'vendorUser', targetEntity: VendorUser::class)]
    private ?VendorProfile $vendorUser = null;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->vendorMessage = new ArrayCollection();
        $this->vendorItem = new ArrayCollection();
        $this->vendorOrder = new ArrayCollection();
        $this->vendorDocument = new ArrayCollection();
        $this->vendorMedia = new ArrayCollection();
        $this->vendorFriend = new ArrayCollection();
        $this->vendorMyFriend = new ArrayCollection();
        $this->isActive = true;
    }

    #[ArrayShape(['firstTitle' => 'string', 'lastTitle' => 'string'])]
    public function jsonSerialize(): array
    {
        return [
            'firstTitle' => $this->getFirstTitle(),
            'lastTitle' => $this->getLastTitle(),
        ];
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool|int $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getResetCount(): ?int
    {
        return $this->resetCount;
    }

    public function setResetCount(?int $resetCount): void
    {
        $this->resetCount = $resetCount;
    }

    public function getOtpKey(): ?string
    {
        return $this->otpKey;
    }

    public function setOtpKey(?string $otpKey): void
    {
        $this->otpKey = $otpKey;
    }

    public function getOtep(): ?string
    {
        return $this->otep;
    }

    public function setOtep(?string $otep): void
    {
        $this->otep = $otep;
    }

    public function getRequireReset(): bool|int
    {
        return $this->requireReset;
    }

    public function setRequireReset(bool|int $requireReset): void
    {
        $this->requireReset = $requireReset;
    }

    public function getVendorSecurity(): VendorSecurity|array
    {
        return $this->vendorSecurity;
    }

    public function setVendorSecurity(VendorSecurity|array $vendorSecurity): void
    {
        $this->vendorSecurity = $vendorSecurity;
    }

    public function getVendorIban(): VendorIban
    {
        return $this->vendorIban;
    }

    public function setVendorIban(VendorIban $vendorIban): void
    {
        $this->vendorIban = $vendorIban;
    }

    public function getVendorEnUs(): VendorEnUS
    {
        return $this->vendorEnUs;
    }

    public function setVendorEnUs(VendorEnUS $vendorEnUs): void
    {
        $this->vendorEnUs = $vendorEnUs;
    }

    public function getVendorFeatured(): Featured
    {
        return $this->vendorFeatured;
    }

    public function setVendorFeatured(Featured $vendorFeatured): void
    {
        $this->vendorFeatured = $vendorFeatured;
    }

    public function getVendorDocument(): Collection
    {
        return $this->vendorDocument;
    }

    public function setVendorDocument(Collection $vendorDocument): void
    {
        $this->vendorDocument = $vendorDocument;
    }

    public function getVendorMedia(): Collection
    {
        return $this->vendorMedia;
    }

    public function setVendorMedia(Collection $vendorMedia): void
    {
        $this->vendorMedia = $vendorMedia;
    }

    public function getVendorOrder(): Collection
    {
        return $this->vendorOrder;
    }

    public function setVendorOrder(Collection $vendorOrder): void
    {
        $this->vendorOrder = $vendorOrder;
    }

    public function getVendorItem(): Collection
    {
        return $this->vendorItem;
    }

    public function setVendorItem(Collection $vendorItem): void
    {
        $this->vendorItem = $vendorItem;
    }

    public function getVendorFavourite(): Collection
    {
        return $this->vendorFavourite;
    }

    public function setVendorFavourite(Collection $vendorFavourite): void
    {
        $this->vendorFavourite = $vendorFavourite;
    }

    public function getVendorConversation(): Collection
    {
        return $this->vendorConversation;
    }

    public function setVendorConversation(Collection $vendorConversation): void
    {
        $this->vendorConversation = $vendorConversation;
    }

    public function getVendorMessage(): Collection
    {
        return $this->vendorMessage;
    }

    public function setVendorMessage(Collection $vendorMessage): void
    {
        $this->vendorMessage = $vendorMessage;
    }

    public function getVendorFriend(): Collection
    {
        return $this->vendorFriend;
    }

    public function setVendorFriend(Collection $vendorFriend): void
    {
        $this->vendorFriend = $vendorFriend;
    }

    public function getVendorMyFriend(): Collection
    {
        return $this->vendorMyFriend;
    }

    public function setVendorMyFriend(Collection $vendorMyFriend): void
    {
        $this->vendorMyFriend = $vendorMyFriend;
    }
}
