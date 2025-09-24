<?php

namespace App\Interface\Vendor;

use App\Entity\Featured\Featured;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderStorage;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorFavourite;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorMessage;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface VendorInterface
{
    public function isActive(): bool;
    public function setIsActive(bool $isActive = false): void;

    public function getLocale(): ?string;
    public function setLocale(string $locale): void;

    public function getResetCount(): int;
    public function setResetCount(int $resetCount): self;

    public function getOtpKey(): string;
    public function setOtpKey(string $otpKey): self;

    public function getOtep(): string;
    public function setOtep(string $otep): self;

    public function isRequireReset(): bool;
    public function setRequireReset(bool $requireReset): self;

    public function getVendorSecurity(): VendorSecurity;
    public function setVendorSecurity(VendorSecurity $vendorSecurity): void;

    public function getVendorEnGb(): VendorEnUS;
    public function setVendorEnGb(VendorEnUS $vendorEnGb): void;
    # OneToMany
    public function getVendorDocument(): Collection;
    public function addVendorDocument(VendorDocument $vendorDocument): self;
    public function removeVendorDocument(VendorDocument $vendorDocument): self;
    # OneToMany
    public function getVendorMedia(): Collection;
    public function addVendorMedia(VendorMedia $vendorMedia): self;
    public function removeVendorMedia(VendorMedia $vendorMedia): self;
    # OneToOne
    public function getVendorIban(): VendorIban;
    public function setVendorIban(VendorIban $vendorIban): void;
    # OneToMany
    public function getVendorOrder(): Collection;
    public function addVendorOrder(OrderStorage $vendorOrder): self;
    public function removeVendorOrder(OrderStorage $vendorOrder): self;
    # ManyToMany
    public function getVendorFavourite(): Collection;
    public function addVendorFavourite(VendorFavourite $vendorFavourite): self;
    public function removeVendorFavourite(VendorFavourite $vendorFavourite): self;
    # OneToOne
    public function getVendorFeatured(): Featured;
    public function setVendorFeatured(Featured $vendorFeatured): void;
    # OneToMany
    public function getVendorItem(): Collection;
    public function addVendorItem(OrderItem $vendorItem): self;
    public function removeVendorItem(OrderItem $vendorItem): self;
    # OneToMany
    public function getVendorMessage(): Collection;
    public function addVendorMessage(VendorMessage $vendorMessage): self;
    public function removeVendorMessage(VendorMessage $vendorMessage): self;
}