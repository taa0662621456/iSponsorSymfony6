<?php

namespace App\MessageDispatcher;

use Symfony\Component\Messenger\MessageBusInterface;

final class ResetPasswordDispatcher implements ResetPasswordDispatcherInterface
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function dispatch(string $token, string $password): void
    {
        $this->messageBus->dispatch(new ResetPassword($token, $password));
    }
}
