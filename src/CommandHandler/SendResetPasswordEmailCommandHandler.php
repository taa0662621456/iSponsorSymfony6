<?php

namespace App\CommandHandler;

use App\Command\SendResetPasswordEmailCommand;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsMessageHandler]
final class SendResetPasswordEmailCommandHandler
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly ChannelRepositoryInterface $channelRepository,
        private readonly VendorRepositoryInterface $userRepository,
        private readonly TranslatorInterface $translator,
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(SendResetPasswordEmailCommand $command): void
    {
        $user = $this->userRepository->findOneByEmail($command->email);
        if (!$user) {
            return;
        }

        $channel = $this->channelRepository->findOneByCode($command->channelCode);

        $email = (new TemplatedEmail())
            ->to($command->email)
            ->subject(
                $this->translator->trans(
                    'email.password_reset.subject',
                    [],
                    null,
                    $command->locale
                )
            )
            ->htmlTemplate('email/password_reset.html.twig')
            ->context([
                'username' => $user->getUsername(),
                'token' => $user->getPasswordResetToken(),
                'channel' => $channel,
            ]);

        $this->mailer->send($email);
    }
}