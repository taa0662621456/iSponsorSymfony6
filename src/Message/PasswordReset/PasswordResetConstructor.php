<?php

namespace App\Message\PasswordReset;

class PasswordResetConstructor
{
    public function __construct(
        public string  $passwordResetToken,
        public ?string $newPassword = null,
        public ?string $confirmNewPassword = null,
    ) {
    }

}