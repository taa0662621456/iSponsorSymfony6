<?php

namespace App\Message;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateCacheHandler implements MessageHandlerInterface
{
    public function __invoke(UpdateCacheMessage $message): void
    {
        // Логика обновления кэша
        // Например:
        // $this->cacheService->set($message->getKey(), $message->getValue());
    }

    public function updateCacheAsync(MessageBusInterface $bus, string $key, string $value): void
    {
        $bus->dispatch(new UpdateCacheMessage($key, $value));
    }

}
