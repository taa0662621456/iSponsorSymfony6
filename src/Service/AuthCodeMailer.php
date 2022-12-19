<?php

namespace App\Service;

use Scheb\TwoFactorBundle\Mailer\AuthCodeMailerInterface;

class AuthCodeMailer implements AuthCodeMailerInterface
{
    public function sendAuthCode(\Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface $user): void
    {
        $authCode = $user->getEmailAuthCode();

        // TODO: Send email
        // https://symfony.com/bundles/SchebTwoFactorBundle/current/providers/email.html#installation
    }

}
