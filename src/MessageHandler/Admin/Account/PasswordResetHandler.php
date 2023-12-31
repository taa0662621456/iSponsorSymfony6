<?php

namespace App\MessageHandler\Admin\Account;


use App\Message\PasswordReset\PasswordResetConstructor;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class PasswordResetHandler
{
    public function __construct(private $passwordReset)
    {
    }

    public function __invoke(PasswordResetConstructor $command): void
    {
        $this->passwordReset->reset($command->passwordResetToken, $command->newPassword);
    }
}
