<?php

namespace App\DTO;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

trait VendorLanguageDTOTrait
{
    /**
     * TODO: добавить свойства: Обложка профиля и аватар c отношением к МедиаАттачментам
     * $vendorCover
     * $vendorAvatar
     * возможно определить данные свойства в BaseDTOTrait.
     */
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorPhone = null;

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorSecondPhone = null;

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorFax = null;

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorAddress = 'address';

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorSecondAddress = null;

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorCity = 'your_city';

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private int $vendorStateId = 0;

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorCountryId = 'country_id';

    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 4, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 7, maxMessage: 'vendors.en.gb.too.long')]
    private int $vendorZip = 0;

    private string $vendorCurrency = 'vendor_currency';

    private string $vendorAcceptedCurrencies = 'vendor_accepted_currencies';

    private ?string $vendorParams = null;

    #[Ignore]
    private Vendor $vendorEnGbVendorDTO;

    public function getVendorPhone(): string
    {
        return $this->vendorPhone;
    }

    public function setVendorPhone(string $vendorPhone): void
    {
        $this->vendorPhone = $vendorPhone;
    }

    public function getVendorSecondPhone(): string
    {
        return $this->vendorSecondPhone;
    }

    public function setVendorSecondPhone(string $vendorSecondPhone): void
    {
        $this->vendorSecondPhone = $vendorSecondPhone;
    }

    public function getVendorFax(): string
    {
        return $this->vendorFax;
    }

    public function setVendorFax(string $fax): void
    {
        $this->vendorFax = $fax;
    }

    public function getVendorAddress(): string
    {
        return $this->vendorAddress;
    }

    public function setVendorAddress(string $address): void
    {
        $this->vendorAddress = $address;
    }

    public function getVendorAddressSecond(): string
    {
        return $this->vendorAddress;
    }

    public function setVendorAddressSecond(string $vendorSecondAddress): void
    {
        $this->vendorSecondAddress = $vendorSecondAddress;
    }

    public function getVendorCity(): string
    {
        return $this->vendorCity;
    }

    public function setVendorCity(string $vendorCity): void
    {
        $this->vendorCity = $vendorCity;
    }

    public function getVendorStateId(): int
    {
        return $this->vendorStateId;
    }

    public function setVendorStateId(int $vendorStateId): void
    {
        $this->vendorStateId = $vendorStateId;
    }

    public function getVendorCountryId(): string
    {
        return $this->vendorCountryId;
    }

    public function setVendorCountryId(string $vendorCountryId): void
    {
        $this->vendorCountryId = $vendorCountryId;
    }

    public function getVendorZip(): int
    {
        return $this->vendorZip;
    }

    public function setVendorZip(int $vendorZip): void
    {
        $this->vendorZip = $vendorZip;
    }

    public function getVendorCurrency(): string
    {
        return $this->vendorCurrency;
    }

    public function setVendorCurrency(string $vendorCurrency): void
    {
        $this->vendorCurrency = $vendorCurrency;
    }

    public function getVendorAcceptedCurrencies(): string
    {
        return $this->vendorAcceptedCurrencies;
    }

    public function setVendorAcceptedCurrencies(string $vendorAcceptedCurrencies): void
    {
        $this->vendorAcceptedCurrencies = $vendorAcceptedCurrencies;
    }

    public function getVendorParams(): string
    {
        return $this->vendorParams;
    }

    public function setVendorParams(string $vendorParams): void
    {
        $this->vendorParams = $vendorParams;
    }

    public function getVendorEnGbVendor(): Vendor
    {
        return $this->vendorEnGbVendor;
    }

    public function setVendorEnGbVendor(Vendor $vendor): void
    {
        $this->vendorEnGbVendor = $vendor;
    }
}
