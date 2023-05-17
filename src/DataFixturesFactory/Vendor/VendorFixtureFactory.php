<?php

namespace App\DataFixturesFactory\Vendor;


use App\DataFixturesFactoryInterface\Vendor\VendorDataFixturesFactoryInterface;
use App\Entity\Featured\Featured;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderStorage;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorFavourite;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorMessage;
use App\Entity\Vendor\VendorSecurity;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;
use Doctrine\Common\Collections\Collection;

class VendorFixtureFactory extends ObjectFactory implements VendorDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

    public function isActive(): bool
    {
        // TODO: Implement isActive() method.
    }

    public function setIsActive(bool $isActive = false): void
    {
        // TODO: Implement setIsActive() method.
    }

    public function getLocale(): ?string
    {
        // TODO: Implement getLocale() method.
    }

    public function setLocale(string $locale): void
    {
        // TODO: Implement setLocale() method.
    }

    public function getResetCount(): int
    {
        // TODO: Implement getResetCount() method.
    }

    public function setResetCount(int $resetCount): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement setResetCount() method.
    }

    public function getOtpKey(): string
    {
        // TODO: Implement getOtpKey() method.
    }

    public function setOtpKey(string $otpKey): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement setOtpKey() method.
    }

    public function getOtep(): string
    {
        // TODO: Implement getOtep() method.
    }

    public function setOtep(string $otep): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement setOtep() method.
    }

    public function isRequireReset(): bool
    {
        // TODO: Implement isRequireReset() method.
    }

    public function setRequireReset(bool $requireReset): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement setRequireReset() method.
    }

    public function getVendorSecurity(): VendorSecurity
    {
        // TODO: Implement getVendorSecurity() method.
    }

    public function setVendorSecurity(VendorSecurity $vendorSecurity): void
    {
        // TODO: Implement setVendorSecurity() method.
    }

    public function getVendorEnUs(): VendorEnUS
    {
        // TODO: Implement getVendorEnUs() method.
    }

    public function setVendorEnUs(VendorEnUS $vendorEnUs): void
    {
        // TODO: Implement setVendorEnUs() method.
    }

    public function getVendorDocument(): Collection
    {
        // TODO: Implement getVendorDocument() method.
    }

    public function addVendorDocument(VendorDocument $vendorDocument): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorDocument() method.
    }

    public function removeVendorDocument(VendorDocument $vendorDocument): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorDocument() method.
    }

    public function getVendorMedia(): Collection
    {
        // TODO: Implement getVendorMedia() method.
    }

    public function addVendorMedia(VendorMedia $vendorMedia): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorMedia() method.
    }

    public function removeVendorMedia(VendorMedia $vendorMedia): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorMedia() method.
    }

    public function getVendorIban(): VendorIban
    {
        // TODO: Implement getVendorIban() method.
    }

    public function setVendorIban(VendorIban $vendorIban): void
    {
        // TODO: Implement setVendorIban() method.
    }

    public function getVendorOrder(): Collection
    {
        // TODO: Implement getVendorOrder() method.
    }

    public function addVendorOrder(OrderStorage $vendorOrder): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorOrder() method.
    }

    public function removeVendorOrder(OrderStorage $vendorOrder): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorOrder() method.
    }

    public function getVendorFavourite(): Collection
    {
        // TODO: Implement getVendorFavourite() method.
    }

    public function addVendorFavourite(VendorFavourite $vendorFavourite): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorFavourite() method.
    }

    public function removeVendorFavourite(VendorFavourite $vendorFavourite): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorFavourite() method.
    }

    public function getVendorFeatured(): Featured
    {
        // TODO: Implement getVendorFeatured() method.
    }

    public function setVendorFeatured(Featured $vendorFeatured): void
    {
        // TODO: Implement setVendorFeatured() method.
    }

    public function getVendorItem(): Collection
    {
        // TODO: Implement getVendorItem() method.
    }

    public function addVendorItem(OrderItem $vendorItem): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorItem() method.
    }

    public function removeVendorItem(OrderItem $vendorItem): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorItem() method.
    }

    public function getVendorMessage(): Collection
    {
        // TODO: Implement getVendorMessage() method.
    }

    public function addVendorMessage(VendorMessage $vendorMessage): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement addVendorMessage() method.
    }

    public function removeVendorMessage(VendorMessage $vendorMessage): VendorDataFixturesFactoryInterface
    {
        // TODO: Implement removeVendorMessage() method.
    }
}
