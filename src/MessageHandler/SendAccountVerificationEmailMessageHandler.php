<?php

namespace App\MessageHandler;

use App\Message\SendAccountVerificationEmailMessage;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsMessageHandler]
final class SendAccountVerificationEmailMessageHandler
{
    public function __construct(
        private readonly VendorRepositoryInterface  $userRepository,
        private readonly ChannelRepositoryInterface $channelRepository,
        private readonly MailerInterface            $mailer,
        private readonly TranslatorInterface        $translator,
    ) {}

    public function __invoke(SendAccountVerificationEmailMessage $command): void
    {
        $user = $this->userRepository->findOneByEmail($command->email);
        $channel = $this->channelRepository->findOneByCode($command->channelCode);

        if (!$user || !$channel) {
            return;
        }

        $subject = $this->translator->trans(
            'email.verification_token.subject',
            [],
            null,
            $command->locale
        );

        $body = $this->translator->trans(
            'email.verification_token.verify_your_email_address',
            [],
            null,
            $command->locale
        );

        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($command->email)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}