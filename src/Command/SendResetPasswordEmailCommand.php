<?php

namespace App\Command;

class SendResetPasswordEmailCommand
{
    public function __construct(
        public readonly string $email,
        public readonly string $channelCode,
        public readonly string $locale,
    ) {}
}
