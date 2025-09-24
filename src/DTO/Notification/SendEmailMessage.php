<?php

namespace App\DTO\Notification;

class SendEmailMessage
{
    public function __construct(
        private readonly string $to,
        private readonly string $subject,
        private readonly string $body,
        private readonly string $from = 'noreply@yourdomain.com'
    ) {}

    public function getTo(): string { return $this->to; }
    public function getSubject(): string { return $this->subject; }
    public function getBody(): string { return $this->body; }
    public function getFrom(): string { return $this->from; }
}
