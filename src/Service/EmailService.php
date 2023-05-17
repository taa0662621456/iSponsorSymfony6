<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailService
{
    private VerifyEmailHelperInterface $verifyEmailHelper;
    private MailerInterface $mailer;

    public function __construct(VerifyEmailHelperInterface $helper, MailerInterface $mailer, private readonly string $adminEmail = 'taa0662621456@gmail.com')
    {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function confirmationSignatureSender(string $confirmationRouteName, UserInterface $vendorSecurity, TemplatedEmail $email): void
    {
        $signature = $this->verifyEmailHelper->generateSignature(
            $confirmationRouteName,
            $vendorSecurity->getId(),
            $vendorSecurity->getEmail(),
            ['slug' => $vendorSecurity->getSlug()]
        );

        $context = $email->getContext();
        $context['signedUrl'] = $signature->getSignedUrl();
        $context['expiresAtMessageKey'] = $signature->getExpirationMessageKey();
        $context['expiresAtMessageData'] = $signature->getExpirationMessageData();

        $email->context($context);

        $this->mailer->send($email);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendErrorNotification(string $errorMessage): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($this->adminEmail)
            ->subject('Error Notification')
            ->text($errorMessage);

        $this->mailer->send($email);
    }
}
