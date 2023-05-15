<?php


namespace App\EventListener\Listener_Sylius;







use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class MailerListener
{
    public function __construct(
        private SenderInterface $emailSender,
        private ChannelContextInterface $channelContext,
        private LocaleContextInterface $localeContext,
    ) {
    }

    public function sendResetPasswordTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), UserBundleEmails::RESET_PASSWORD_TOKEN);
    }

    public function sendResetPasswordPinEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), UserBundleEmails::RESET_PASSWORD_PIN);
    }

    public function sendVerificationTokenEmail(GenericEvent $event): void
    {
        $this->sendEmail($event->getSubject(), UserBundleEmails::EMAIL_VERIFICATION_TOKEN);
    }

    public function sendUserRegistrationEmail(GenericEvent $event): void
    {
        $customer = $event->getSubject();

        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        if (null === $user) {
            return;
        }

        $email = $customer->getEmail();
        if (empty($email)) {
            return;
        }

        Assert::isInstanceOf($user, ShopUserInterface::class);

        $this->sendEmail($user, CoreBundleEmails::USER_REGISTRATION);
    }

    private function sendEmail(UserInterface $user, string $emailCode): void
    {
        $email = $user->getEmail();
        Assert::notNull($email);

        $this->emailSender->send(
            $emailCode,
            [$email],
            [
                'user' => $user,
                'channel' => $this->channelContext->getChannel(),
                'localeCode' => $this->localeContext->getLocaleCode(),
            ],
        );
    }
}
