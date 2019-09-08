<?php
declare(strict_types=1);

namespace App\Service;

class MyMessageHandler
{
    public function __invoke ( MyMessageHandler $message )
    {
        // Message processing...
    }
}