<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseWebTestCase extends WebTestCase
{
    protected static $client;

    public static function setUpBeforeClass(): void
    {
        self::ensureKernelShutdown();
        self::$client = self::createClient();
    }

}
