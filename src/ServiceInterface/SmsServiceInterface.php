<?php

namespace App\Service;

interface SmsServiceInterface
{
    public function send(string $phoneE164, string $message): void;

}