<?php


namespace App\Entity;


use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnGb;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

trait VendorLanguageTrait
{
    /**
     * TODO: добавить свойства: Обложка профиля и аватар c отношением к МедиаАтачментам
     * $vendorCover
     * $vendorAvatar
     * возможно определить данные свойства в BaseTrait
     */

    #[ORM\Column(name: 'vendor_first_name', type: 'string', nullable: false, options: ['default' => 'vendor_first_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorFirstName = 'vendor_first_name';


    #[ORM\Column(name: 'vendor_last_name', type: 'string', nullable: false, options: ['default' => 'vendor_last_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorLastName = 'vendor_last_name';


    #[ORM\Column(name: 'vendor_middle_name', type: 'string', nullable: false, options: ['default' => 'vendor_middle_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorMiddleName = 'vendor_middle_name';


    #[ORM\Column(name: 'vendor_phone', unique: true)]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorPhone = null;


    #[ORM\Column(name: 'vendor_second_phone')]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorSecondPhone = null;


    #[ORM\Column(name: 'vendor_fax')]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 10, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 12, maxMessage: 'vendors.en.gb.too.long')]
    private ?string $vendorFax = null;


    #[ORM\Column(name: 'vendor_address', type: 'string', nullable: false, options: ['default' => 'address'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorAddress = 'address';


    #[ORM\Column(name: 'vendor_second_address')]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorSecondAddress = null;


    #[ORM\Column(name: 'vendor_city', type: 'string', nullable: false, options: ['default' => 'your_city'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorCity = 'your_city';


    #[ORM\Column(name: 'vendor_state_id', type: 'integer', nullable: false, options: ['default' => 0])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private int $vendorStateId = 0;


    #[ORM\Column(name: 'vendor_country_id', type: 'string', nullable: false, options: ['default' => 'country_id'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 1, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorCountryId = 'country_id';


    #[ORM\Column(name: 'vendor_zip', type: 'integer', nullable: false, options: ['default' => '000000'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 4, minMessage: 'vendors.en.gb.too.short')]
    #[Length(max: 7, maxMessage: 'vendors.en.gb.too.long')]
    private int $vendorZip = 0;


    #[ORM\Column(name: 'vendor_currency', type: 'string', nullable: false, options: ['default' => 'vendor_currency'])]
    private string $vendorCurrency = 'vendor_currency';


    #[ORM\Column(name: 'vendor_accepted_currencies', type: 'string', nullable: false, options: ['default' => 'vendor_accepted_currencies'])]
    private string $vendorAcceptedCurrencies = 'vendor_accepted_currencies';


    #[ORM\Column(name: 'vendor_params', type: 'string', nullable: false, options: ['default' => 'vendor_params'])]
    private string $vendorParams = 'vendor_params';


    #[ORM\Column(name: 'vendor_meta_robot', type: 'string', nullable: false, options: ['default' => 'meta_robot'])]
    private string $vendorMetaRobot = 'meta_robot';


    #[ORM\Column(name: 'vendor_meta_author')]
    private ?string $vendorMetaAuthor = null;

    #[ORM\OneToOne(inversedBy: 'vendorEnGb', targetEntity: Vendor::class)]
    #[ORM\JoinColumn(name: 'vendorEnGb_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?VendorEnGb $vendorEnGb = null;

    public function getVendorFirstName(): string
    {
        return $this->vendorFirstName;
    }

    public function setVendorFirstName(string $vendorFirstName): void
    {
        $this->vendorFirstName = $vendorFirstName;
    }

    public function getVendorLastName(): string
    {
        return $this->vendorLastName;
    }

    public function setVendorLastName(string $lastName): void
    {
        $this->vendorLastName = $lastName;
    }

    public function getVendorMiddleName(): string
    {
        return $this->vendorMiddleName;
    }

    public function setVendorMiddleName(string $vendorMiddleName): void
    {
        $this->vendorMiddleName = $vendorMiddleName;
    }

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

    public function getVendorMetaRobot(): string
    {
        return $this->vendorMetaRobot;
    }

    public function setVendorMetaRobot(string $vendorMetaRobot): void
    {
        $this->vendorMetaRobot = $vendorMetaRobot;
    }

    public function getVendorMetaAuthor(): string
    {
        return $this->vendorMetaAuthor;
    }

    public function setVendorMetaAuthor(string $vendorMetaAuthor): void
    {
        $this->vendorMetaAuthor = $vendorMetaAuthor;
    }

    public function getVendorEnGb(): VendorEnGb
    {
        return $this->vendorEnGb;
    }

    /**
     * @param $vendorEnGb
     */
    public function setVendorEnGb($vendorEnGb): void
    {
        $this->vendorEnGb = $vendorEnGb;
    }


}
