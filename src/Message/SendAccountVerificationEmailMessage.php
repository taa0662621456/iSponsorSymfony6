<?php

namespace App\Message;

final class SendAccountVerificationEmailMessage
{
    public function __construct(
        public string $email,
        public string $locale,
        public string $channelCode
    ) {}
}
