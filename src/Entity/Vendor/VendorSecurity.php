<?php

namespace App\Entity\Vendor;

use Faker\Factory;
use App\Entity\OAuthTrait;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Service\ConfirmationCodeGenerator;
use Symfony\Component\Validator\Constraints as Assert;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;
use Symfony\Component\Security\Core\User\UserInterface;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Index(columns: ['email', 'phone'], name: 'idx_email_phone')]
#[ORM\UniqueConstraint(name: 'vendor_security_idx', columns: ['slug', 'email', 'phone'])]

#[ORM\Entity]
class VendorSecurity extends ObjectSuperEntity implements ObjectInterface, \Serializable, PasswordAuthenticatedUserInterface, UserInterface, TwoFactorInterface
{
    use OAuthTrait;

    #[ORM\Column(name: 'email', type: 'string', unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(name: 'phone', type: 'string', unique: false, nullable: true)]
    private string $phone = '0 000 00 00';

    #[ORM\Column(name: 'username', type: 'string', length: 255)]
    private string $username;

    #[ORM\Column(name: 'password', type: 'string', unique: false)]
    protected string $password = 'A7k0B9f8A7k0B9f8A7k0B9f8';

    private string $plainPassword = 'A7k0B9f8A7k0B9f8A7k0B9f8';

    #[ORM\Column(name: 'roles', type: 'json', nullable: false)]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(name: 'send_email', nullable: false, options: ['default' => false])]
    private ?bool $sendEmail = false;

    #[ORM\Column(name: 'activation_code', type: 'string', nullable: false, options: ['default' => 'activation_code'])]
    private string $activationCode;

    #[ORM\Column(name: 'locale', type: 'string', nullable: false, options: ['default' => 'en'])]
    private string $locale = 'en';

    #[ORM\Column(name: 'params', type: 'string', nullable: false, options: ['default' => 'params'])]
    private string $params = 'params';

    #[ORM\Column(name: 'last_reset_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Date of last password reset'])]
    private string $lastResetTime;

    #[ORM\Column(name: 'reset_count', options: ['comment' => 'Count of password resets'])]
    private ?int $resetCount = 0;

    #[ORM\Column(name: 'totp_key', type: 'string', nullable: true, options: ['comment' => 'Two factor'])]
    private string $totpKey;

    #[ORM\Column(name: 'otep', type: 'string', nullable: true, options: ['comment' => 'One time emergency'])]
    private string $otep;

    #[ORM\Column(name: 'require_reset', type: 'boolean', nullable: false, options: ['comment' => 'Require user to reset'])]
    private int|bool $requireReset = 0;

    #[ORM\Column(name: 'api_key', type: 'string', nullable: false, options: ['comment' => 'API key'])]
    private string $apiKey = 'api_key';

    #[ORM\OneToOne(inversedBy: 'vendorSecurity', targetEntity: Vendor::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Vendor $vendorSecurity;

    #[ORM\Column(name: 'salt', type: 'string')]
    private string $salt = '0';

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $faker = Factory::create();

        $t = new \DateTime();
        $uuid = (string) Uuid::v4();
        $this->username = $uuid;

        $this->email = $faker->unique()->email;
        $this->phone = $faker->unique()->phoneNumber;

        $codeGenerator = new ConfirmationCodeGenerator();
        $this->activationCode = $codeGenerator->getConfirmationCode();
        $this->lastResetTime = $t->format('Y-m-d H:i:s');
    }

    public function setPhone(string $phone): self
    {
        $this->phone = preg_replace("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", '', $phone);

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
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
    public function isPasswordUsername(): bool
    {
        return $this->username !== $this->plainPassword;
    }

    #[Assert\IsTrue(message: 'The password cannot match your email')]
    public function isPasswordMail(): bool
    {
        return $this->email !== $this->plainPassword;
    }

    public function eraseCredentials(): self
    {
        $this->plainPassword = '';

        return $this;
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
            $this->phone,
        ]);
    }

    public function unserialize(string $data): void
    {
        [
            $this->id,
            $this->email,
            $this->password
        ] = unserialize($data, ['allowed_class' => false]);
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
        return [];
    }

    public function __unserialize(array $data): void
    {
        // TODO: Implement __unserialize() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function isTotpAuthenticationEnabled(): bool
    {
        return $this->totpKey ? true : false;
    }

    public function getTotpAuthenticationConfiguration(): ?TotpConfigurationInterface
    {
        // You could persist the other configuration options in the user entity to make it individual per user.
        return new TotpConfiguration($this->totpKey, TotpConfiguration::ALGORITHM_SHA1, 30, 6);
    }

    public function isEmailAuthEnabled(): bool
    {
        return true; // This can be a persisted field to switch email code authentication on/off
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }

    public function getEmailAuthCode(): string
    {
        if (null === $this->otep) {
            throw new \LogicException('The email authentication code was not set');
        }

        return $this->otep;
    }

    public function setEmailAuthCode(string $otep): void
    {
        $this->otep = $otep;
    }
}
