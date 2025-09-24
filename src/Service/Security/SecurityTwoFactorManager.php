<?php

namespace App\Service\Security;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;

class SecurityTwoFactorManager
{
    public function __construct(
        private readonly TotpAuthenticatorInterface $totpAuthenticator,
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Включает 2FA, если ещё не включено.
     * Возвращает секрет (для QR-кода).
     */
    public function enableForUser(VendorSecurity $user): string
    {
        if (!$user->isTotpAuthenticationEnabled()) {
            $secret = $this->totpAuthenticator->generateSecret();
            $user->setTotpSecret($secret);
            $this->em->flush();

            $this->logger->info('2FA enabled', ['user' => $user->getUserIdentifier()]);
            return $secret;
        }

        return $user->getTotpSecret();
    }

    /**
     * Проверяет введённый код.
     */
    public function validateTotp(VendorSecurity $user, string $code): bool
    {
        if (!$user->getTotpSecret()) {
            $this->logger->warning('2FA validation attempted without secret', ['user' => $user->getUserIdentifier()]);
            return false;
        }

        return $this->totpAuthenticator->checkCode($user, $code);
    }

    /**
     * Отключает 2FA.
     */
    public function disableForUser(VendorSecurity $user): void
    {
        $user->setTotpSecret(null);
        $this->em->flush();

        $this->logger->info('2FA disabled', ['user' => $user->getUserIdentifier()]);
    }

    /**
     * Проверяет, включена ли 2FA.
     */
    public function isEnabled(VendorSecurity $user): bool
    {
        return $user->isTotpAuthenticationEnabled();
    }
}
