<?php

namespace App\DTO\Vendor;

use App\DTO\Abstraction\ObjectDTO;
use App\Entity\Featured\Featured;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

final class VendorDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    #[Groups(['vendor:list', 'vendor:item'])]

    private int|bool $isActive;

    #[Groups(['vendor:list', 'vendor:item'])]

    private string $locale = 'en';

    private ?int $resetCount = null;

    private ?string $otpKey = null;

    private ?string $otep = null;

    private int|bool $requireReset = false;

    #[Assert\Type(type: VendorSecurity::class)]
    #[Assert\Valid]
    #[Ignore]
    private array|VendorSecurity $vendorSecurity;

    #[Assert\Type(type: VendorIban::class)]
    #[Assert\Valid]
    #[Ignore]
    private VendorIban $vendorIbanDTO;

    #[Assert\Type(type: VendorEnUS::class)]
    #[Assert\Valid]
    #[Ignore]
    private VendorEnUS $vendorEnUsDTO;

    #[Assert\Type(type: Featured::class)]
    #[Assert\Valid]
    #[Ignore]
    private Featured $vendorFeaturedDTO;

    private Collection $vendorDocumentDTO;

    private Collection $vendorOrderDTO;

    private Collection $vendorItemDTO;

    private Collection $vendorFavouriteDTO;

    private Collection $vendorConversationDTO;

    private Collection $vendorFriendDTO;

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
}
