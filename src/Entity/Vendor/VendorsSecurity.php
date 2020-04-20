<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;


/**
 * @ORM\Table(name="vendors_security", indexes={
 * @ORM\Index(name="vendor_security_idx", columns={"slug", "email", "phone"})}, uniqueConstraints={
 * @ORM\UniqueConstraint(name="vendor_security_idx", columns={"slug", "email", "phone"})})
 * @UniqueEntity("email",
 *        errorPath="email",
 *        message="You have an account already or this email already in use!")
 * @UniqueEntity("phone",
 *        errorPath="phone",
 *        message="You have an account already or this phone already in use!")
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorsSecurityRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsSecurity implements UserInterface, Serializable
{
	use BaseTrait;

	public const ROLE_USER = 'ROLE_USER';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 * @Assert\NotBlank(message="vendors_security.blank_content")
	 * @Assert\Length(min=3)
	 * @Assert\Email(message = "The email '{{ value }}' is not a valid.")
	 */
	private $email = 'taa0662621456@gmail.com';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="string", nullable=true)
	 * @Assert\NotBlank(message="vendors.message.error.phone")
	 * @Length(min=10, minMessage="vendors_security.too_short_content")
	 * @Length(max=12, maxMessage="vendors_security.too_long_content")
	 */
	private $phone = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", unique=true, nullable=false, options={"default" : 0})
	 */
	private $password = '0';

	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(min=8)
	 * @Assert\Length(max=16)
	 *
	 */
	private $plainPassword = '0';

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
	private $sendEmail = null;

	/**
	 * @var DateTime
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
	 * @var DateTime
	 *
	 * @ORM\Column(name="last_reset_time", type="datetime", nullable=false, options={"comment"="Date of last password
     *                                     reset"})
     * @Assert\DateTime()
	 */
	private $lastResetTime;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="reset_count", type="integer", options={"comment"="Count of password resets
     * since lastResetTime"})
     *
	 */
	private $resetCount = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="otp_key", type="string", nullable=false, options={"default"="","comment"="Two factor
     * authentication encrypted keys"})
     *
	 */
	private $otpKey = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="otep", type="string", nullable=false, options={"default"="","comment"="One time emergency
     * passwords"})
     *
	 */
	private $otep = '';

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="require_reset", type="boolean", nullable=false, options={"comment"="Require user to reset
     * password on next login"})
     *
	 */
	private $requireReset = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="api_key", type="string", nullable=false, options={"comment"="API key"})
	 */
	private $apiKey = 'api_key';

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors",
	 *     cascade={"persist", "remove"},
	 *     inversedBy="vendorSecurity")
	 */
	private $vendorSecurity;


	/**
	 * VendorsSecurity constructor.
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->roles = [self::ROLE_USER];
		$this->lastResetTime = new DateTime();
		$this->lastVisitDate = new DateTime();
	}

	/**
	 * @ORM\Column(name="salt", type="string")
	 */
	private $salt = '0';

	/**
	 * @return string
	 */
	public function getApiKey(): string
	{
		return $this->apiKey;
	}

	/**
	 * @param string $apiKey
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
	 */
	public function setEmail(string $email): self
	{
		$this->email = $email;
		return $this;
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
	 * @return bool|null
	 */
	public function getSendEmail(): ?bool
	{
		return $this->sendEmail;
	}

	/**
	 * @param bool|null $sendEmail
	 *
	 * @return VendorsSecurity
	 */
	public function setSendEmail(?bool $sendEmail): self
	{
		$this->sendEmail = $sendEmail;
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
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
	 */
	public function setParams(string $params): self
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getLastResetTime(): DateTime
	{
		return $this->lastResetTime;
	}

	/**
	 * @param DateTime $lastResetTime
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
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
	 *
	 * @return VendorsSecurity
	 */
	public function setRequireReset(bool $requireReset): self
	{
		$this->requireReset = $requireReset;
		return $this;
	}

	/**
	 * Returns the roles granted to the user.
	 *
	 *     public function getRoles()
	 *     {
	 *         return ['ROLE_USER'];
	 *     }
	 *
	 * Alternatively, the roles might be stored on a ``roles`` property,
	 * and populated in any number of different ways when the user object
	 * is created.
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
	 * @param array $roles
	 */
	public function setRoles(array $roles): void
	{
		$this->roles = $roles;
	}


	/**
	 * Returns the password used to authenticate the user.
	 *
	 * This should be the encoded password. On authentication, a plain-text
	 * password will be salted, encoded, and then compared to this value.
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 *
	 * @return VendorsSecurity
	 */
	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlainPassword(): string
	{
		return $this->plainPassword;
	}

	/**
	 * @param string $plainPassword
	 *
	 * @return VendorsSecurity
	 */
	public function setPlainPassword(string $plainPassword): self
	{
		$this->plainPassword = $plainPassword;

		return $this;
	}

	/**
	 * Returns the salt that was originally used to encode the password.
	 *
	 * This can return null if the password was not encoded using a salt.
	 *
	 */
	public function getSalt()
	{
		// TODO: Implement getSalt() method.
		return null;
	}

	/**
	 * Removes sensitive data from the user.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 */
	public function eraseCredentials(): string
	{
		$this->plainPassword = null;
		return '';
	}

	/**
	 * String representation of object
	 *
	 * @link  https://php.net/manual/en/serializable.serialize.php
	 * @return string the string representation of the object or null
	 * @since 5.1.0
	 */
	public function serialize(): string
	{
		return serialize([
			$this->id,
			$this->email,
			$this->password
		]);

	}

	/**
	 * Constructs the object
	 *
	 * @link  https://php.net/manual/en/serializable.unserialize.php
	 *
	 * @param string $serialized <p>
	 *
	 * @return void
	 * @since 5.1.0
	 */
	public function unserialize($serialized): void
	{
		[
			$this->id,
			$this->email,
			$this->password
		] = unserialize($serialized, ['allowed_class' => false]);
	}

	/**
	 * Returns the username used to authenticate the user.
	 *
	 * @return string The username
	 */
	public function getUsername(): string
	{
		return $this->email;
	}

	/**
	 * @return mixed
	 */
	public function getVendorSecurity()
	{
		return $this->vendorSecurity;
	}


	/**
	 * @param Vendors $vendorSecurity
	 */
	public function setVendorSecurity(Vendors $vendorSecurity): void
	{
		$this->vendorSecurity = $vendorSecurity;
	}


}

