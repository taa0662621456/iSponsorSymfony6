<?php

namespace App\MessageHandler\Admin\Account;

use App\Interface\VendorRepositoryInterface;
use App\Message\MailNotificationMap;
use App\Message\PasswordReset\PasswordResponseConstructor;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Webmozart\Assert\Assert;

final class ResetPasswordEmailHandler implements MessageHandlerInterface
{
    public function __construct(
//        private readonly VendorRepositoryInterface $vendorRepository,
//        private readonly SenderInterface           $sender,
    ) {
    }

    public function __invoke(PasswordResponseConstructor $sendResetPasswordEmail): void
    {
        $vendor = $this->vendorRepository->findOneByEmail($sendResetPasswordEmail->email);
        Assert::notNull($vendor);

        $this->sender->send(
            MailNotificationMap::ADMIN_PASSWORD_RESET,
            [$sendResetPasswordEmail->email],
            [
                'vendor' => $vendor,
                'localeCode' => $sendResetPasswordEmail->localeCode,
            ],
        );
    }
}
