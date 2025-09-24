<?php
namespace App\Service;

use App\Entity\Vendor\VendorSecurity;
use App\ServiceInterface\TwoFactorServiceInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;

class TotpTwoFactorService implements TwoFactorServiceInterface
{
    public function __construct(
        private readonly TotpAuthenticatorInterface $totpAuthenticator
    ) {}

    public function prepare(VendorSecurity $user): void
    {
        if (!$user->getTotpSecret()) {
            $user->setTotpSecret($this->totpAuthenticator->generateSecret());
        }
    }

    public function validate(VendorSecurity $user, string $code): bool
    {
        return $this->totpAuthenticator->checkCode($user, $code);
    }

    public function getMethodName(): string
    {
        return 'totp';
    }
}