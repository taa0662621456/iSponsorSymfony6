<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="vendors_en_gb")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsEnGb
{

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_first_name", type="string", nullable=false, options={"default"="vendor_first_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorFirstName = 'vendor_first_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="vendor_last_name", type="string", nullable=false, options={"default"="vendor_last_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorLastName = 'vendor_last_name';

    /**
     * @var string|null
     *
     * @ORM\Column(name="vendor_middle_name", type="string", nullable=false, options={"default"="vendor_middle_name"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorMiddleName = 'vendor_middle_name';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_phone", type="string", nullable=false, unique=true, options={"default"="0000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=12, maxMessage="vendors_en_gb.too_long_content")
     */
    private $vendorPhone = '0000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_second_phone", type="string", nullable=true, unique=true, options={"default"="0000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=12, maxMessage="vendors_en_gb.too_long_content")
     */
    private $vendorSecondPhone = '0000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_fax", type="string", nullable=true, options={"default"="000000000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=10, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=11, maxMessage="vendors_en_gb.too_long_content")
     */
    private $vendorFax = '000000000000';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_address", type="string", nullable=false, options={"default"="address"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorAddress = 'address';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_second_address", type="string", nullable=true, options={"default"="address_second"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=6, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorSecondAddress = 'address_second';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_city", type="string", nullable=false, options={"default"="your_city"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorCity = 'your_city';

    /**
     * @var int
     *
     * @ORM\Column(name="vendor_state_id", type="integer", nullable=false, options={"default"="0"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorStateId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_country_id", type="string", nullable=false, options={"default"="country_id"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=1, minMessage="vendors_en_gb.too_short_content")
     */
    private $vendorCountryId = 'country_id';

    /**
     * @var int
     *
     * @ORM\Column(name="vendor_zip", type="integer", nullable=false, options={"default"="000000"})
     * @Assert\NotBlank(message="vendors_en_gn.blank_content")
     * @Length(min=4, minMessage="vendors_en_gb.too_short_content")
     * @Length(max=7, maxMessage="vendors_en_gb.too_long_content")
     */
    private $vendorZip = 0;

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
     * @ORM\Column(name="vendor_meta_robot", type="string", nullable=false, options={"default"="meta_robot"})
     */
    private $vendorMetaRobot = 'meta_robot';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_meta_author", type="string", nullable=true, options={"default"="meta_author"})
     */
    private $vendorMetaAuthor = 'meta_author';

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
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorEnGb")
     * @ORM\JoinColumn(name="vendorsEnGb_id", referencedColumnName="id", onDelete="CASCADE")
     */
	private $vendorsEnGb;

















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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
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
     * @return string|null
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
	public function getVendorsEnGb()
	{
		return $this->vendorsEnGb;
	}

	/**
	 * @param Vendors $vendorsEnGb
	 */
	public function setVendorsEnGb(Vendors $vendorsEnGb): void
	{
		$this->vendorsEnGb = $vendorsEnGb;
	}



}
