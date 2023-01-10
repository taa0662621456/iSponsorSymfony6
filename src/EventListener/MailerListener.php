<?php

namespace App\EventListener;

use App\Event\EmailEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

class MailerListener
{
    public function __construct(protected SenderInterface $emailSender)
    {
    }

    public function sendResetPasswordTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), EmailEvent::EMAIL_RESET_PASSWORD_TOKEN);
    }

    public function sendResetPasswordPinEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), EmailEvent::EMAIL_RESET_PASSWORD_PIN);
    }

    public function sendVerificationTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), EmailEvent::EMAIL_VERIFICATION_TOKEN);
    }

    protected function sendEmail(UserInterface $user, string $emailCode): void
    {
        $email = $user->getEmail();
        Assert::notNull($email);

        $this->emailSender->send($emailCode, [$email], ['user' => $user]);
    }
}
