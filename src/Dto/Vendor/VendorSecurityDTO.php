<?php

namespace App\Dto\Vendor;

use App\Dto\Abstraction\ObjectDTO;
use App\Entity\Vendor\Vendor;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\OAuthTrait;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

// #[UniqueEntity(errorPath: 'email', message: 'email.already.use')]
// #[UniqueEntity(errorPath: 'phone', message: 'phone.already.use')]

final class VendorSecurityDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    use OAuthTrait;

    #[Assert\NotBlank(message: 'vendors.security.blank_email')]
    #[Assert\Length(min: 3)]
    #[Assert\Email(message: "The email '{{ value }}' is not a valid.", mode: 'strict')]
    private string $email;

    #[Assert\NotBlank(message: 'vendor.message.error.phone')]
    #[Length(min: 9, minMessage: 'vendor.security.too.short.phone')]
    #[Length(max: 13, maxMessage: 'vendor.security.too.long.phone')]
    private string $phoneDTO;

    #[Assert\Length(min: 3, minMessage: 'vendor.security.too.short.username')]
    #[Assert\Length(max: 64, maxMessage: 'vendor.security.too.long.username')]
    private string $usernameDTO;

    #[Assert\NotBlank(message: 'vendors.message.error.password')]
    #[Assert\Length(min: 8, minMessage: 'vendor.security.too.short.password')]
    #[Assert\Length(max: 32, maxMessage: 'vendor.security.too.long.password')]
    protected string $password = 'A7k0B9f8A7k0B9f8A7k0B9f8';

    #[Assert\NotBlank]
    #[Assert\Length(min: 8, minMessage: 'vendor.security.too.short.plainPassword')]
    #[Assert\Length(max: 32, maxMessage: 'vendor.security.too.long.plainPassword')]
    #[Assert\NotCompromisedPassword(message: 'This password has been leaked in a data breach, it must not be used. Please use another password.', skipOnError: true)]
    private string $plainPassword = 'A7k0B9f8A7k0B9f8A7k0B9f8';

    private array $roles = ['ROLE_USER'];

    private ?bool $sendEmail = false;

    private string $activationCodeDTO;

    #[Assert\Locale(message: 'Код локали должен соответствовать стандарту языка ISO 639-1 или с применением стардарта кода страны  ISO 3166-1 alpha-2', canonicalize: true)]
    private string $locale = 'en';

    private string $params = 'params';

    private string $lastResetTimeDTO;

    private ?int $resetCount = 0;

    private string $totpKeyDTO;

    private string $otepDTO;

    private int|bool $requireReset = 0;

    private string $apiKey = 'api_key';

    private Vendor $vendorSecurityDTO;

    private string $salt = '0';


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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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
        ] = unserialize($data, ['allowed_final class' => false]);
    }

    // OneToOne
    public function getVendorSecurity(): Vendor
    {
        return $this->vendorSecurity;
    }

    public function setVendorSecurity(Vendor $vendorSecurity): self
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

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
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

    public function getTotpAuthenticationUsername(): string
    {
        return $this->username;
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