<?php

namespace App\Service;

use Scheb\TwoFactorBundle\Mailer\AuthCodeMailerInterface;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;

class AuthCodeMailer implements AuthCodeMailerInterface
{
    public function sendAuthCode(TwoFactorInterface $user): void
    {
        $authCode = $user->getEmailAuthCode();

        // TODO: Send email
        // https://symfony.com/bundles/SchebTwoFactorBundle/current/providers/email.html#installation
    }
}
