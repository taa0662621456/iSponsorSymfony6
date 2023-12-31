<?php

namespace App\MessageHandler\Admin\Account;

use App\Interface\DateTimeProviderInterface;
use App\Interface\SecurityGeneratorInterface;
use App\Message\PasswordReset\PasswordRequestConstructor;
use App\Message\PasswordReset\PasswordResponseConstructor;
use App\Repository\Vendor\VendorSecurityRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class RequestResetPasswordEmailHandler
{
    public function __construct(
        private readonly VendorSecurityRepository   $vendorSecurityRepository,
        private readonly SecurityGeneratorInterface $generator,
        private readonly MessageBusInterface        $commandBus,
        private readonly LoggerInterface            $logger
    )
    {
    }

    public function __invoke(PasswordRequestConstructor $requestResetPasswordEmail):void
    {
        $vendorSecurity = $this->vendorSecurityRepository->findOneBy(['email' => $requestResetPasswordEmail->email]);
        if (null === $vendorSecurity) {
            $this->logger->info('Password reset requested for a non-existing account.', [
                'email' => $requestResetPasswordEmail->email,
            ]);

            return;
        }

        $vendorSecurity->setPasswordResetToken($this->generator->generate());

        $this->commandBus->dispatch(
            new PasswordResponseConstructor($vendorSecurity->getEmail(), $vendorSecurity->getLocaleCode()),
            [new DispatchAfterCurrentBusStamp()],
        );
    }
}
