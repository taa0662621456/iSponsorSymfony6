<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Vendors
 *
 * @ORM\Table(name="vendors_en_gb")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * UniqueEntity(fields={"phone"})
 * UniqueEntity(fields={"phone_second"}, message="Phone number already taken")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsEnGb
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", nullable=false, options={"default"="first_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $firstName = 'first_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", nullable=false, options={"default"="last_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $lastName = 'last_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="middle_name", type="string", nullable=false, options={"default"="middle_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $middleName = 'middle_name';

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=false, unique=true, options={"default"="0000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=12, maxMessage="vendors_en_gb.too_long_content")
     */
    private $phone = '0000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_second", type="string", nullable=true, unique=true, options={"default"="0000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=12, maxMessage="vendors_en_gb.too_long_content")
     */
    private $phoneSecond = '0000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", nullable=true, options={"default"="000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=11, maxMessage="vendors_en_gb.too_long_content")
     */
    private $fax = '000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", nullable=false, options={"default"="address"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $address = 'address';

    /**
     * @var string
     *
     * @ORM\Column(name="address_second", type="string", nullable=true, options={"default"="address_second"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $addressSecond = 'address_second';

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=false, options={"default"="your_city"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $city = 'your_city';

    /**
     * @var int
     *
     * @ORM\Column(name="state_id", type="integer", nullable=false, options={"default"="0"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $stateId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="country_id", type="string", nullable=false, options={"default"="country_id"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $countryId = 'country_id';

    /**
     * @var int
     *
     * @ORM\Column(name="zip", type="integer", nullable=false, options={"default"="000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=4, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=7, maxMessage="vendors_en_gb.too_long_content")
     */
    private $zip = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_currency", type="string", nullable=false, options={"default"="vendor_currency"})
     *
     */
    private $vendorCurrency = 'vendor_currency';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_accepted_currencies", type="string", nullable=false, options={"default"="vendor_accepted_currencies"})
     */
    private $vendorAcceptedCurrencies = 'vendor_accepted_currencies';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_params", type="string", nullable=false, options={"default"="vendor_params"})
     */
    private $vendorParams = 'vendor_params';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_robot", type="string", nullable=false, options={"default"="meta_robot"})
     */
    private $metaRobot = 'meta_robot';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_author", type="string", nullable=true, options={"default"="meta_author"})
     */
    private $metaAuthor = 'meta_author';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 0})
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 0})
     */
    private $modifiedBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false)
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 0})
     */
    private $lockedBy = 0;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorEnGb", orphanRemoval=true)
     * @ORM\JoinColumn(name="vendorEnGb_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $vendorEnGb;

















    /**
     * Vendors constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->createdOn = new DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName(string $middleName): void
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhoneSecond(): string
    {
        return $this->phoneSecond;
    }

    /**
     * @param string $phoneSecond
     */
    public function setPhoneSecond(string $phoneSecond): void
    {
        $this->phoneSecond = $phoneSecond;
    }

    /**
     * @return string|null
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddressSecond(): string
    {
        return $this->address;
    }

    /**
     * @param string|null $addressSecond
     */
    public function setAddressSecond(string $addressSecond): void
    {
        $this->addressSecond = $addressSecond;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }

    /**
     * @param int $stateId
     */
    public function setStateId(int $stateId): void
    {
        $this->stateId = $stateId;
    }

    /**
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return int
     */
    public function getZip(): int
    {
        return $this->zip;
    }

    /**
     * @param int $zip
     */
    public function setZip(int $zip): void
    {
        $this->zip = $zip;
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
    public function getMetaRobot(): string
    {
        return $this->metaRobot;
    }

    /**
     * @param string $metaRobot
     */
    public function setMetaRobot(string $metaRobot): void
    {
        $this->metaRobot = $metaRobot;
    }

    /**
     * @return string
     */
    public function getMetaAuthor(): string
    {
        return $this->metaAuthor;
    }

    /**
     * @param string $metaAuthor
     */
    public function setMetaAuthor(string $metaAuthor): void
    {
        $this->metaAuthor = $metaAuthor;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */
    public function getModifiedOn(): DateTime
    {
        return $this->modifiedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function setModifiedOn(): void
    {
        $this->modifiedOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception

     */
    public function setLockedOn(): void
    {
        $this->lockedOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

	/**
	 * @return mixed
	 */
	public function getVendorEnGb()
	{
		return $this->vendorEnGb;
	}

	/**
	 * @param mixed $vendorEnGb
	 */
	public function setVendorEnGb(Vendors $vendorEnGb): void
	{
		$this->vendorEnGb = $vendorEnGb;
	}



}
