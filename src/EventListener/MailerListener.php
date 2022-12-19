<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

class MailerListener
{
    public function __construct(protected SenderInterface $emailSender)
    {
    }

    public function sendResetPasswordTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), Emails::RESET_PASSWORD_TOKEN);
    }

    public function sendResetPasswordPinEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), Emails::RESET_PASSWORD_PIN);
    }

    public function sendVerificationTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), Emails::EMAIL_VERIFICATION_TOKEN);
    }

    protected function sendEmail(UserInterface $user, string $emailCode): void
    {
        $email = $user->getEmail();
        Assert::notNull($email);

        $this->emailSender->send($emailCode, [$email], ['user' => $user]);
    }
}
