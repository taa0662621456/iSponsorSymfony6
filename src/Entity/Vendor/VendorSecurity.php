<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\OAuthTrait;
use App\Entity\BaseTrait;

use App\Service\ConfirmationCodeGenerator;
use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints\Length;


/**
 *
 * @ApiResource()
 * TODO: https://symfonycasts.com/screencast/api-platform/user-resource#play
 * TODO: не реализовал один из методов интерфейса
 *
 * @method string getUserIdentifier()
 */
#[ORM\Table(name: 'vendors_security')]
#[ORM\Index(name: 'vendor_security_idx', columns: ['slug', 'email', 'phone'])]
#[ORM\UniqueConstraint(name: 'vendor_security_idx', columns: ['slug', 'email', 'phone'])]
//#[UniqueEntity(errorPath: 'email', message: 'email.already.use')]
//#[UniqueEntity(errorPath: 'phone', message: 'phone.already.use')]
#[ORM\Entity(repositoryClass: \App\Repository\Vendor\VendorSecurityRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorSecurity implements Serializable, PasswordAuthenticatedUserInterface
{
	use BaseTrait;
	use OAuthTrait;

	#[ORM\Column(name: 'email', type: 'string', unique: true, nullable: false)]
	#[Assert\NotBlank(message: 'vendors.security.blank_email')]
	#[Assert\Length(min: 3)]
	#[Assert\Email(message: "The email '{{ value }}' is not a valid.", mode: 'strict')]
	private string $email = 'exemple@domail.com';

	#[ORM\Column(name: 'phone', type: 'string', unique: true, nullable: false)]
	#[Assert\NotBlank(message: 'vendor.message.error.phone')]
	#[Length(min: 9, minMessage: 'vendor.security.too.short.phone')]
	#[Length(max: 13, maxMessage: 'vendor.security.too.long.phone')]
	private string $phone = '380662621456';

	#[ORM\Column(name: 'username', type: 'string', length: 255)]
	#[Assert\Length(min: 3, minMessage: 'vendor.security.too.short.username')]
	#[Assert\Length(max: 64, maxMessage: 'vendor.security.too.long.username')]
	private string $username = '380662621456';

	#[ORM\Column(name: 'password', type: 'string', unique: false)]
	#[Assert\NotBlank(message: 'vendors.message.error.password')]
	#[Assert\Length(min: 8, minMessage: 'vendor.security.too.short.password')]
	#[Assert\Length(max: 32, maxMessage: 'vendor.security.too.long.password')]
	protected string $password = 'A7k0B9f8A7k0B9f8A7k0B9f8';

	#[Assert\NotBlank]
	#[Assert\Length(min: 8, minMessage: 'vendor.security.too.short.plainPassword')]
	#[Assert\Length(max: 32, maxMessage: 'vendor.security.too.long.plainPassword')]
	#[Assert\NotCompromisedPassword(message: 'This password has been leaked in a data breach, it must not be used. Please use another password.', skipOnError: true)]
	private string $plainPassword = 'A7k0B9f8A7k0B9f8A7k0B9f8';

	#[ORM\Column(name: 'roles', type: 'array')]
	private array $roles = ["ROLE_USER"];

	#[ORM\Column(name: 'send_email')]
	private ?bool $sendEmail = null;

	#[ORM\Column(name: 'activation_code', type: 'string', nullable: false, options: ['default' => 'activation_code'])]
	private string $activationCode = 'activation_code';

	#[ORM\Column(name: 'locale', type: 'string', nullable: false, options: ['default' => 'en'])]
	#[Assert\Locale(canonicalize: true, message: 'Код локали должен соответствовать стандарту языка ISO 639-1 или с применением стардарта кода страны  ISO 3166-1 alpha-2')]
	private string $locale = 'en';
	# TODO: засунуть также Предпочитаемый язык объектов поумолчанию
	# https://symfony.com.ua/doc/current/reference/constraints/Language.html

	#[ORM\Column(name: 'params', type: 'string', nullable: false, options: ['default' => 'params'])]
	private string $params = 'params';

	#[ORM\Column(name: 'last_reset_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Date of last password reset'])]
	private string $lastResetTime = '0000-00-00 00:00:00';

	#[ORM\Column(name: 'reset_count', options: ['comment' => 'Count of password resets'])]
	private ?int $resetCount = 0;

	#[ORM\Column(name: 'otp_key', type: 'string', nullable: false, options: ['default' => '', 'comment' => 'Two factor'])]
	private string $otpKey = '';

	#[ORM\Column(name: 'otep', type: 'string', nullable: false, options: ['default' => '', 'comment' => 'One time emergency'])]
	private string $otep = '';

	#[ORM\Column(name: 'require_reset', type: 'boolean', nullable: false, options: ['comment' => 'Require user to reset'])]
	private int|bool $requireReset = 0;

	#[ORM\Column(name: 'api_key', type: 'string', nullable: false, options: ['comment' => 'API key'])]
	private string $apiKey = 'api_key';

	#[ORM\OneToOne(targetEntity: \App\Entity\Vendor\Vendor::class, inversedBy: 'vendorSecurity')]
	#[ORM\JoinColumn(name: 'vendorSecurity_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private ?Vendor $vendorSecurity = null;

	#[ORM\Column(name: 'salt', type: 'string')]
	private string $salt = '0';
	/**
	 * @throws Exception
	 */
	public function __construct()
    {
        $t = new DateTime();
        $uuid = (string)Uuid::v4();
        $this->slug = $uuid;
        $this->username = $uuid;
        $codeGenerator = new ConfirmationCodeGenerator;
        $this->activationCode = (string)$codeGenerator->getConfirmationCode();
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->lastResetTime = $t->format('Y-m-d H:i:s');
    }
    public function getUser(): string
    {
        return $this->username;
    }

    public function getUsername(): string
    {
        return $this->email;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
	public function getApiKey(): string
    {
        return $this->apiKey;
    }
	public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }
	public function getEmail(): ?string
    {
        return $this->email;
    }
	public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
	public function getPhone(): string
    {
        return $this->phone;
    }
	public function setPhone(string $phone): self
    {
        $this->phone = preg_replace("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/","",$phone);
        return $this;
    }
    public function getSendEmail(): ?bool
    {
        return $this->sendEmail;
    }
	public function setSendEmail(?bool $sendEmail): self
    {
        $this->sendEmail = $sendEmail;
        return $this;
    }
	public function getActivationCode(): string
    {
        return $this->activationCode;
    }
    public function setActivationCode(string $activationCode): self
    {
    $this->activationCode = $activationCode;
    return $this;
    }
	public function getLocale(): string
    {
        return $this->locale;
    }
	public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }
	public function getParams(): string
    {
        return $this->params;
    }
	public function setParams(string $params): self
    {
        $this->params = $params;
        return $this;
    }
	public function getLastResetTime(): string
    {
        return $this->lastResetTime;
    }
	public function setLastResetTime(string $lastResetTime): self
    {
        $this->lastResetTime = $lastResetTime;
        return $this;
    }
	public function getResetCount(): int
    {
        return $this->resetCount;
    }
	public function setResetCount(int $resetCount): self
    {
        $this->resetCount = $resetCount;
        return $this;
    }
	public function getOtpKey(): string
    {
        return $this->otpKey;
    }
	public function setOtpKey(string $otpKey): self
    {
        $this->otpKey = $otpKey;
        return $this;
    }
	public function getOtep(): string
    {
        return $this->otep;
    }
	public function setOtep(string $otep): self
    {
        $this->otep = $otep;
        return $this;
    }
	public function isRequireReset(): bool
    {
        return $this->requireReset;
    }
	public function setRequireReset(bool $requireReset): self
    {
        $this->requireReset = $requireReset;
        return $this;
    }
	public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
	public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    public function getPassword(): string
    {
     return $this->password;
    }
	public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
	#[Assert\IsTrue(message: 'The password cannot match your Username')]
    public function isPasswordUsername()
    {
     return $this->username !== $this->plainPassword;
    }
	#[Assert\IsTrue(message: 'The password cannot match your email')]
    public function isPasswordMail()
    {
     return $this->email !== $this->plainPassword;
    }
	public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }
	public function setPlainPassword(string $password): self
    {
        $this->plainPassword = $password;
        return $this;
    }
    public function eraseCredentials(): self
    {
     $this->plainPassword = '';
     return $this;
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
            $this->password,
            $this->phone
        ]);

    }
	/**
	 * Constructs the object
	 *
	 * @link  https://php.net/manual/en/serializable.unserialize.php
	 *
	 * @param string $data <p>
	 *
	 * @since 5.1.0
	 */
	public function unserialize($data): void
    {
        [
            $this->id,
            $this->email,
            $this->password
        ] = unserialize($data, ['allowed_class' => false]);
    }
	public function getVendorSecurity(): Vendor
    {
        return $this->vendorSecurity;
    }
	/**
	 * @param $vendorSecurity
	 */
	public function setVendorSecurity($vendorSecurity): self
    {
        $this->vendorSecurity = $vendorSecurity;
    }
    public function getSalt()
    {
     // TODO: Implement getSalt() method.
    }
    public function __call(string $name, array $arguments)
    {
     // TODO: Implement @method string getUserIdentifier()
    }
}

