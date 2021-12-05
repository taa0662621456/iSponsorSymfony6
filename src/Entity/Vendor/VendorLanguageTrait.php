<?php


namespace App\Entity\Vendor;


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

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_first_name", type="string", nullable=false, options={"default"="vendor_first_name"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=6, minMessage="vendors.en.gb.too.short")
     */
    private string $vendorFirstName = 'vendor_first_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="vendor_last_name", type="string", nullable=false, options={"default"="vendor_last_name"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=6, minMessage="vendors.en.gb.too.short")
     */
    private ?string $vendorLastName = 'vendor_last_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="vendor_middle_name", type="string", nullable=false, options={"default"="vendor_middle_name"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=6, minMessage="vendors.en.gb.too.short")
     */
    private ?string $vendorMiddleName = 'vendor_middle_name';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_phone", type="string", nullable=true, unique=true,
     *     options={"default"="000000000000"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=10, minMessage="vendors.en.gb.too.short")
     * @Length(max=12, maxMessage="vendors.en.gb.too.long")
     */
    private string $vendorPhone = '000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_second_phone", type="string", nullable=true, options={"default"="000000000000"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=10, minMessage="vendors.en.gb.too.short")
     * @Length(max=12, maxMessage="vendors.en.gb.too.long")
     */
    private string $vendorSecondPhone = '000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_fax", type="string", nullable=true, options={"default"="000000000000"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=10, minMessage="vendors.en.gb.too.short")
     * @Length(max=12, maxMessage="vendors.en.gb.too.long")
     */
    private string $vendorFax = '000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_address", type="string", nullable=false, options={"default"="address"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=6, minMessage="vendors.en.gb.too.short")
     */
    private string $vendorAddress = 'address';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_second_address", type="string", nullable=true, options={"default"="address_second"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=6, minMessage="vendors.en.gb.too.short")
     */
    private string $vendorSecondAddress = 'address_second';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_city", type="string", nullable=false, options={"default"="your_city"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=1, minMessage="vendors.en.gb.too.short")
     */
    private string $vendorCity = 'your_city';

    /**
     * @var int
     *
     * @ORM\Column(name="vendor_state_id", type="integer", nullable=false, options={"default"="0"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=1, minMessage="vendors.en.gb.too.short")
     */
    private int $vendorStateId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_country_id", type="string", nullable=false, options={"default"="country_id"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=1, minMessage="vendors.en.gb.too.short")
     */
    private string $vendorCountryId = 'country_id';

    /**
     * @var int
     *
     * @ORM\Column(name="vendor_zip", type="integer", nullable=false, options={"default"="000000"})
     * @Assert\NotBlank(message="vendors.en.gb.blank")
     * @Length(min=4, minMessage="vendors.en.gb.too.short")
     * @Length(max=7, maxMessage="vendors.en.gb.too.long")
     */
    private int $vendorZip = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_currency", type="string", nullable=false, options={"default"="vendor_currency"})
     *
     */
    private string $vendorCurrency = 'vendor_currency';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_accepted_currencies", type="string", nullable=false, options={"default"="vendor_accepted_currencies"})
     */
    private string $vendorAcceptedCurrencies = 'vendor_accepted_currencies';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_params", type="string", nullable=false, options={"default"="vendor_params"})
     */
    private string $vendorParams = 'vendor_params';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_meta_robot", type="string", nullable=false, options={"default"="meta_robot"})
     */
    private string $vendorMetaRobot = 'meta_robot';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_meta_author", type="string", nullable=true, options={"default"="meta_author"})
     */
    private string $vendorMetaAuthor = 'meta_author';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendor", inversedBy="vendorEnGb")
     * @ORM\JoinColumn(name="vendorEnGb_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private VendorEnGb $vendorEnGb;

    /**
     * @return string
     */
    public function getVendorFirstName(): string
    {
        return $this->vendorFirstName;
    }

    /**
     * @param string $vendorFirstName
     */
    public function setVendorFirstName(string $vendorFirstName): void
    {
        $this->vendorFirstName = $vendorFirstName;
    }

    /**
     * @return string
     */
    public function getVendorLastName(): string
    {
        return $this->vendorLastName;
    }

    /**
     * @param string $lastName
     */
    public function setVendorLastName(string $lastName): void
    {
        $this->vendorLastName = $lastName;
    }

    /**
     * @return string
     */
    public function getVendorMiddleName(): string
    {
        return $this->vendorMiddleName;
    }

    /**
     * @param string $vendorMiddleName
     */
    public function setVendorMiddleName(string $vendorMiddleName): void
    {
        $this->vendorMiddleName = $vendorMiddleName;
    }

    /**
     * @return string
     */
    public function getVendorPhone(): string
    {
        return $this->vendorPhone;
    }

    /**
     * @param string $vendorPhone
     */
    public function setVendorPhone(string $vendorPhone): void
    {
        $this->vendorPhone = $vendorPhone;
    }

    /**
     * @return string
     */
    public function getVendorSecondPhone(): string
    {
        return $this->vendorSecondPhone;
    }

    /**
     * @param string $vendorSecondPhone
     */
    public function setVendorSecondPhone(string $vendorSecondPhone): void
    {
        $this->vendorSecondPhone = $vendorSecondPhone;
    }

    /**
     * @return string
     */
    public function getVendorFax(): string
    {
        return $this->vendorFax;
    }

    /**
     * @param string $fax
     */
    public function setVendorFax(string $fax): void
    {
        $this->vendorFax = $fax;
    }

    /**
     * @return string
     */
    public function getVendorAddress(): string
    {
        return $this->vendorAddress;
    }

    /**
     * @param string $address
     */
    public function setVendorAddress(string $address): void
    {
        $this->vendorAddress = $address;
    }

    /**
     * @return string
     */
    public function getVendorAddressSecond(): string
    {
        return $this->vendorAddress;
    }

    /**
     * @param string $vendorSecondAddress
     */
    public function setVendorAddressSecond(string $vendorSecondAddress): void
    {
        $this->vendorSecondAddress = $vendorSecondAddress;
    }

    /**
     * @return string
     */
    public function getVendorCity(): string
    {
        return $this->vendorCity;
    }

    /**
     * @param string $vendorCity
     */
    public function setVendorCity(string $vendorCity): void
    {
        $this->vendorCity = $vendorCity;
    }

    /**
     * @return int
     */
    public function getVendorStateId(): int
    {
        return $this->vendorStateId;
    }

    /**
     * @param int $vendorStateId
     */
    public function setVendorStateId(int $vendorStateId): void
    {
        $this->vendorStateId = $vendorStateId;
    }

    /**
     * @return string
     */
    public function getVendorCountryId(): string
    {
        return $this->vendorCountryId;
    }

    /**
     * @param string $vendorCountryId
     */
    public function setVendorCountryId(string $vendorCountryId): void
    {
        $this->vendorCountryId = $vendorCountryId;
    }

    /**
     * @return int
     */
    public function getVendorZip(): int
    {
        return $this->vendorZip;
    }

    /**
     * @param int $vendorZip
     */
    public function setVendorZip(int $vendorZip): void
    {
        $this->vendorZip = $vendorZip;
    }

    /**
     * @return string
     */
    public function getVendorCurrency(): string
    {
        return $this->vendorCurrency;
    }

    /**
     * @param string $vendorCurrency
     */
    public function setVendorCurrency(string $vendorCurrency): void
    {
        $this->vendorCurrency = $vendorCurrency;
    }

    /**
     * @return string
     */
    public function getVendorAcceptedCurrencies(): string
    {
        return $this->vendorAcceptedCurrencies;
    }

    /**
     * @param string $vendorAcceptedCurrencies
     */
    public function setVendorAcceptedCurrencies(string $vendorAcceptedCurrencies): void
    {
        $this->vendorAcceptedCurrencies = $vendorAcceptedCurrencies;
    }

    /**
     * @return string
     */
    public function getVendorParams(): string
    {
        return $this->vendorParams;
    }

    /**
     * @param string $vendorParams
     */
    public function setVendorParams(string $vendorParams): void
    {
        $this->vendorParams = $vendorParams;
    }

    /**
     * @return string
     */
    public function getVendorMetaRobot(): string
    {
        return $this->vendorMetaRobot;
    }

    /**
     * @param string $vendorMetaRobot
     */
    public function setVendorMetaRobot(string $vendorMetaRobot): void
    {
        $this->vendorMetaRobot = $vendorMetaRobot;
    }

    /**
     * @return string
     */
    public function getVendorMetaAuthor(): string
    {
        return $this->vendorMetaAuthor;
    }

    /**
     * @param string $vendorMetaAuthor
     */
    public function setVendorMetaAuthor(string $vendorMetaAuthor): void
    {
        $this->vendorMetaAuthor = $vendorMetaAuthor;
    }

    /**
     * @return VendorEnGb
     */
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
