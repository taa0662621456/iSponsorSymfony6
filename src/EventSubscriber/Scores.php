<?php
declare(strict_types=1);

namespace App\EventSubscriber;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Scores implements MessageComponentInterface {

    private $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;

        $this->games = \App\Fixture\Scores::random();
    }

    public function onOpen(ConnectionInterface $conn):void
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        // New connection, send it the current set of matches
        $conn->send(json_encode(array('type' => 'init', 'games' => $this->games)));

        echo "New connection! ({$conn->resourceId})\n";    }

    public function onMessage(ConnectionInterface $from, $msg):void
    {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn):void
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

}