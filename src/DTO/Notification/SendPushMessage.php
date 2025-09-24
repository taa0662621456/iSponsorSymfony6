<?php

namespace App\DTO\Notification;

class SendPushMessage
{
    public function __construct(
        private readonly string $deviceToken,
        private readonly string $message
    ) {}

    public function getDeviceToken(): string { return $this->deviceToken; }
    public function getMessage(): string { return $this->message; }
}
