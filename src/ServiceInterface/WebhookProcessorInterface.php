<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface WebhookProcessorInterface
{
    public function handle(string $gateway, Request $request): bool; // true если обработали
}