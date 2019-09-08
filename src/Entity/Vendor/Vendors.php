<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\Order\Orders;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="vendors")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * @UniqueEntity(fields="email", message="You have an account alredy!")
 * @ORM\HasLifecycleCallbacks()
 */
class Vendors
{
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Primary Key"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default":0})
     */
    private $isActive;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json_array", nullable=false)
     */
    private $roles = [];


    /**
     * @var boolean|null
     *
     * @ORM\Column(name="send_email", type="boolean", nullable=true)
     */
    private $sendEmail = '0';

    /**
     * @var datetime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate;

    /**
     * @var datetime
     *
     * @ORM\Column(name="last_visit_date", type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    private $lastVisitDate;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_code", type="string", nullable=false, options={"default"="0"})
     */
    private $activationCode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="text", nullable=false, options={"default"="en"})
     */
    private $locale = 'en';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false, options={"default"="params"})
     */
    private $params = 'params';

    /**
     * @var datetime
     *
     * @ORM\Column(name="last_reset_time", type="datetime", nullable=false, options={"comment"="Date of last password reset"})
     * @Assert\DateTime()
     */
    private $lastResetTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="reset_count", type="integer", nullable=false, options={"comment"="Count of password resets since lastResetTime"})
     */
    private $resetCount = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="otp_key", type="string", nullable=false, options={"default"="","comment"="Two factor authentication encrypted keys"})
     */
    private $otpKey = '';

    /**
     * @var string
     *
     * @ORM\Column(name="otep", type="string", nullable=false, options={"default"="","comment"="One time emergency passwords"})
     */
    private $otep = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="require_reset", type="boolean", nullable=false, options={"comment"="Require user to reset password on next login"})
     */
    private $requireReset = 0;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsSecurity", mappedBy="security", cascade={"persist", "remove"})
     * @Assert\Type(type="App\Entity\Vendor\VendorsSecurity"))
     * @Assert\Valid()
     */
    private $security;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\VendorsEnGb", mappedBy="vendor", cascade={"persist", "remove"})
     * @Assert\Type(type="App\Entity\Vendor\VendorsEnGb"))
     * @Assert\Valid()
     */
    private $vendorEnGb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order\Orders", mappedBy="vendors")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="VendorsDocAttachments", mappedBy="vendor")
     */
    private $vendorsDocAttachments;

    /**
     * @ORM\OneToMany(targetEntity="VendorsMediaAttachments", mappedBy="vendor")
     */
    private $vendorsMediaAttachments;

















    /**
     * Vendors constructor.
     */
    public function __construct()
    {
        $this->roles = [self::ROLE_USER];
        $this->lastResetTime = new \DateTime();
        $this->lastVisitDate = new \DateTime();
        $this->registerDate = new \DateTime();
        $this->isActive = false;
        $this->orders = new ArrayCollection();
        $this->vendorsDocAttachments = new ArrayCollection();
        $this->vendorsMediaAttachments = new ArrayCollection();
    }

    /**
     *
     * @ORM\Column(name="salt", type="string")
     */
    private $salt ='0';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Vendors
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Vendors
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param bool $isActive
     * @return bool
     */
    public function getIsActive(bool $isActive): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return Vendors
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSendEmail(): ?bool
    {
        return $this->sendEmail;
    }

    /**
     * @param bool|null $sendEmail
     * @return Vendors
     */
    public function setSendEmail(?bool $sendEmail): self
    {
        $this->sendEmail = $sendEmail;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getRegisterDate(): DateTime
    {
        return $this->registerDate;
    }

    /**
     * @param DateTime $registerDate
     * @return Vendors
     */
    public function setRegisterDate(DateTime $registerDate): self
    {
        $this->registerDate = $registerDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastVisitDate(): DateTime
    {
        return $this->lastVisitDate;
    }

    /**
     * @param DateTime $lastVisitDate
     * @return Vendors
     */
    public function setLastVisitDate(DateTime $lastVisitDate): self
    {
        $this->lastVisitDate = $lastVisitDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    /**
     * @param string $activationCode
     * @return Vendors
     */
    public function setActivationCode(string $activationCode): self
    {
        $this->activationCode = $activationCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getParams(): string 
    {
        return $this->params;
    }

    /**
     * @param string $params
     * @return Vendors
     */
    public function setParams(string $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastResetTime(): \DateTime
    {
        return $this->lastResetTime;
    }

    /**
     * @param DateTime $lastResetTime
     * @return Vendors
     */
    public function setLastResetTime(DateTime $lastResetTime): self
    {
        $this->lastResetTime = $lastResetTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getResetCount(): int
    {
        return $this->resetCount;
    }

    /**
     * @param int $resetCount
     * @return Vendors
     */
    public function setResetCount(int $resetCount): self
    {
        $this->resetCount = $resetCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtpKey(): string
    {
        return $this->otpKey;
    }

    /**
     * @param string $otpKey
     * @return Vendors
     */
    public function setOtpKey(string $otpKey): self
    {
        $this->otpKey = $otpKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtep(): string
    {
        return $this->otep;
    }

    /**
     * @param string $otep
     * @return Vendors
     */
    public function setOtep(string $otep): self
    {
        $this->otep = $otep;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequireReset(): bool
    {
        return $this->requireReset;
    }

    /**
     * @param bool $requireReset
     * @return Vendors
     */
    public function setRequireReset(bool $requireReset): self
    {
        $this->requireReset = $requireReset;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getRoles(): array
    {
        return [
            'ROLE_USER'
        ];
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
    public function setVendorEnGb($vendorEnGb): void
    {
        $this->vendorEnGb = $vendorEnGb;
    }

    /**
     * @param Orders $orders
     * @return Vendors
     */
    public function addOrder(Orders $orders): Vendors
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * @param Orders $orders
     */
    public function removeOrder(Orders $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param VendorsDocAttachments $vendorsDocAttachments
     * @return Vendors
     */
    public function addVendorsDocAttachments(VendorsDocAttachments $vendorsDocAttachments): Vendors
    {
        $this->vendorsDocAttachments[] = $vendorsDocAttachments;

        return $this;
    }

    /**
     * @param VendorsDocAttachments $vendorsDocAttachments
     */
    public function removeVendorsDocAttachments(VendorsDocAttachments $vendorsDocAttachments)
    {
        $this->vendorsDocAttachments->removeElement($vendorsDocAttachments);
    }

    /**
     * @return mixed
     */
    public function getVendorsDocAttachments()
    {
        return $this->vendorsDocAttachments;
    }

    /**
     * @param VendorsMediaAttachments $vendorsMediaAttachments
     * @return Vendors
     */
    public function addVendorsMediaAttachments(VendorsMediaAttachments $vendorsMediaAttachments): Vendors
    {
        $this->vendorsMediaAttachments[] = $vendorsMediaAttachments;

        return $this;
    }

    /**
     * @param VendorsMediaAttachments $vendorsMediaAttachments
     */
    public function removeVendorsMediaAttachments(VendorsMediaAttachments $vendorsMediaAttachments)
    {
        $this->vendorsMediaAttachments->removeElement($vendorsMediaAttachments);
    }

    /**
     * @return mixed
     */
    public function getVendorsMediaAttachments()
    {
        return $this->vendorsMediaAttachments;
    }

}

