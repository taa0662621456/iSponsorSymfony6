<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\SmsNotification ;
use Ratchet\ConnectionInterface;
use Ratchet\MessageInterface;

class SmsNotificationHandler implements MessageInterface
{
    public function __invoke (SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }

    /**
     * Triggered when a client sends data through the socket
     * @param \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param string $msg The message received
     * @throws \Exception
     */
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        // TODO: Implement onMessage() method.
    }
}