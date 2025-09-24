<?php

namespace App\Message;

final class SendAccountRegistrationEmailMessage
{
    public function __construct(
        private readonly string $email,
        private readonly string $locale,
        private readonly string $channelCode,
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getChannelCode(): string
    {
        return $this->channelCode;
    }
}