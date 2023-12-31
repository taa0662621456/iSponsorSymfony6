<?php

namespace App\MessageHandler\Admin\Account;

use App\Message\MailNotificationMap;
use App\Message\PasswordReset\PasswordResponseConstructor;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Webmozart\Assert\Assert;

final class ResetPasswordEmailHandler
{
    public function __construct(
        private readonly VendorRepositoryInterface $vendorRepository,
        private readonly SenderInterface           $sender,
    ) {
    }

    public function __invoke(PasswordResponseConstructor $sendResetPasswordEmail): void
    {
        $vendor = $this->vendorRepository->findOneBy(['mail' => $sendResetPasswordEmail->email]);
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
