<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Order\OrderItem;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Entity\Order\OrderStorage;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\EntityInterface\Vendor\VendorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @property ArrayCollection $vendorItem
 */
#[ORM\Entity]
class Vendor extends RootEntity implements ObjectInterface, VendorInterface, JsonSerializable
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

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

    #[ORM\OneToOne(mappedBy: 'vendorIban', targetEntity: VendorIban::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private VendorIban $vendorIban;

    #[ORM\OneToOne(mappedBy: 'vendorEnUs', targetEntity: VendorEnUS::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private VendorEnUS $vendorEnUs;

    #[ORM\OneToOne(mappedBy: 'vendorEnGb', targetEntity: VendorEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private VendorEnUS $vendorEnGb;

    #[ORM\OneToOne(mappedBy: 'vendorFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private Featured $vendorFeatured;

    #[ORM\OneToMany(mappedBy: 'vendorDocumentAttachment', targetEntity: VendorDocumentAttachment::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorDocumentAttachment;

    #[ORM\OneToMany(mappedBy: 'vendorMediaAttachment', targetEntity: VendorMediaAttachment::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorMediaAttachment;

    #[ORM\OneToMany(mappedBy: 'vendorProfileAvatar', targetEntity: VendorProfileAvatar::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorProfileAvatar;

    #[ORM\OneToMany(mappedBy: 'vendorProfileCover', targetEntity: VendorProfileCover::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorProfileCover;

    #[ORM\OneToMany(mappedBy: 'orderVendor', targetEntity: OrderStorage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorOrder;

    #[ORM\OneToMany(mappedBy: 'orderItemVendor', targetEntity: OrderItem::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorOrderItem;

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
    private VendorProfile $vendorProfile;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->vendorMessage = new ArrayCollection();
        $this->vendorItem = new ArrayCollection();
        $this->vendorOrder = new ArrayCollection();
        $this->vendorDocumentAttachment = new ArrayCollection();
        $this->vendorMediaAttachment = new ArrayCollection();
        $this->vendorProfileAvatar = new ArrayCollection();
        $this->vendorProfileCover = new ArrayCollection();
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

    public function getVendorDocumentAttachment(): Collection
    {
        return $this->vendorDocumentAttachment;
    }

    public function setVendorDocument($vendorDocumentAttachment): void
    {
        $this->addVendorDocumentAttachment($vendorDocumentAttachment);
    }

    public function addVendorDocumentAttachment($vendorDocumentAttachment): void
    {
        if ($vendorDocumentAttachment instanceof VendorMediaAttachment) {
            if (!$this->vendorDocumentAttachment->contains($vendorDocumentAttachment)) {
                $this->vendorDocumentAttachment->add($vendorDocumentAttachment);
            }
        } elseif ($vendorDocumentAttachment instanceof Collection) {
            foreach ($vendorDocumentAttachment as $attachment) {
                $this->addVendorMediaAttachment($attachment);
            }
        }
    }

    public function getVendorMediaAttachment(): Collection
    {
        return $this->vendorMediaAttachment;
    }

    public function setVendorMediaAttachment($vendorMediaAttachment): void
    {
        $this->addVendorMediaAttachment($vendorMediaAttachment);
    }

    public function addVendorMediaAttachment($vendorMediaAttachment): void
    {
        if ($vendorMediaAttachment instanceof VendorMediaAttachment) {
            if (!$this->vendorMediaAttachment->contains($vendorMediaAttachment)) {
                $this->vendorMediaAttachment->add($vendorMediaAttachment);
            }
        } elseif ($vendorMediaAttachment instanceof Collection) {
            foreach ($vendorMediaAttachment as $attachment) {
                $this->addVendorMediaAttachment($attachment);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getVendorProfileAvatar(): Collection
    {
        return $this->vendorProfileAvatar;
    }

    /**
     * @param $vendorProfileAvatar
     */
    public function setVendorProfileAvatar($vendorProfileAvatar): void
    {
        $this->vendorProfileAvatar = $vendorProfileAvatar;
    }

    public function addVendorProfileAvatar($vendorProfileAvatar): void
    {
        if ($vendorProfileAvatar instanceof VendorProfileAvatar) {
            if (!$this->vendorProfileAvatar->contains($vendorProfileAvatar)) {
                $this->vendorProfileAvatar->add($vendorProfileAvatar);
            }
        } elseif ($vendorProfileAvatar instanceof Collection) {
            foreach ($vendorProfileAvatar as $avatar) {
                $this->addVendorProfileAvatar($avatar);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getVendorProfileCover(): Collection
    {
        return $this->vendorProfileCover;
    }

    /**
     * @param Collection $vendorProfileCover
     */
    public function setVendorProfileCover(Collection $vendorProfileCover): void
    {
        $this->vendorProfileCover = $vendorProfileCover;
    }

    public function getVendorOrder(): Collection
    {
        return $this->vendorOrder;
    }

    public function setVendorOrder(Collection $vendorOrder): void
    {
        $this->vendorOrder = $vendorOrder;
    }

    public function getVendorOrderItem(): Collection
    {
        return $this->vendorOrderItem;
    }

    public function setVendorOrderItem(Collection $vendorOrderItem): void
    {
        $this->vendorOrderItem = $vendorOrderItem;
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
