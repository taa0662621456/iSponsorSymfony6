<?php

namespace App\Interface;

use App\Entity\Featured\Featured;
use App\Entity\Order\Order;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
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

    public function getVendorEnGb(): VendorEnGb;

    public function setVendorEnGb(VendorEnGb $vendorEnGb): void;

    public function getOrders(): ArrayCollection;

    public function addOrder(Order $order): Vendor;

    public function removeOrder(Order $order): void;

    public function getVendorDocumentAttachments(): ArrayCollection;

    public function addVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment): Vendor;

    public function removeVendorDocumentAttachment(VendorDocument $vendorDocumentAttachment): void;

    public function getVendorMediaAttachments(): ArrayCollection;

    public function addVendorMediaAttachment(VendorMedia $vendorMediaAttachment): Vendor;

    public function removeVendorMediaAttachment(VendorMedia $vendorMediaAttachment): void;

    public function getVendorIban(): VendorIban;

    public function setVendorIban($vendorIban): void;

    public function getVendorOrders(): ArrayCollection;

    public function setVendorOrders($vendorOrders): void;

    public function getVendorFavourite(): Collection;

    public function setVendorFavourite($vendorFavourite): void;

    public function getVendorFeatured(): Featured;

    public function setVendorFeatured($vendorFeatured): void;

    public function getVendorItems(): ArrayCollection;

    public function setVendorItems($vendorItems): void;

    public function getVendorMessage(): ArrayCollection;

    public function setVendorMessage($vendorMessage): void;

    public function getParticipant(): ArrayCollection;

    public function setParticipant($participant): void;

}
