<?php

namespace App\MessageHandler;

use App\Message\SendAccountRegistrationEmailMessage;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsMessageHandler]
final class SendAccountRegistrationEmailMessageHandler
{
    public function __construct(
        private readonly VendorRepositoryInterface $userRepository,
        private readonly ChannelRepositoryInterface $channelRepository,
        private readonly MailerInterface $mailer,
        private readonly TranslatorInterface $translator,
    ) {}

    public function __invoke(SendAccountRegistrationEmailMessage $message): void
    {
        $user = $this->userRepository->findOneByEmail($message->getEmail());
        $channel = $this->channelRepository->findOneByCode($message->getChannelCode());

        if (!$user || !$channel) {
            return;
        }

        $subject = $this->translator->trans(
            'email.user_registration.subject',
            [],
            null,
            $message->getLocale()
        );

        $body = $this->translator->trans(
            'email.user_registration.start_shopping',
            [],
            null,
            $message->getLocale()
        );

        $email = (new Email())
            ->to($user->getEmail())
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}