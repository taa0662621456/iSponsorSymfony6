<?php

namespace App\MessageHandler\Admin\Account;

use App\Account\DateTimeProviderInterface;
use App\Interface\GeneratorInterface;
use App\Message\PasswordReset\PasswordRequestConstructor;
use App\Message\PasswordReset\PasswordResponseConstructor;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class RequestResetPasswordEmailHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly VendorSecurityRepository  $vendorSecurityRepository,
        private readonly GeneratorInterface        $generator,
//        private readonly DateTimeProviderInterface $calendar,
//        private readonly MessageBusInterface       $commandBus,
    )
    {
    }

    public function __invoke(PasswordRequestConstructor $requestResetPasswordEmail)
    {
        $vendorSecurity = $this->vendorSecurityRepository->findOneByEmail($requestResetPasswordEmail->email);
        if (null === $vendorSecurity) {
            return;
        }

        $vendorSecurity->setPasswordRequestedAt($this->calendar->now());
        $vendorSecurity->setPasswordResetToken($this->generator->generate());

        $this->commandBus->dispatch(
            new PasswordResponseConstructor($vendorSecurity->getEmail(), $vendorSecurity->getLocaleCode()),
            [new DispatchAfterCurrentBusStamp()],
        );
    }
}
