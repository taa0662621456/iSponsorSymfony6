<?php

namespace App\MessageHandler;

use App\Message\SendPushMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendPushMessageHandler
{
    public function __invoke(SendPushMessage $message): void
    {
        // TODO: интеграция с Firebase / OneSignal
    }
}
