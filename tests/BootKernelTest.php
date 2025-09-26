<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BootKernelTest extends KernelTestCase
{
    public function bootstrap()
    {
        self::bootKernel([
            'environment' => 'dev_env',
            'debug'       => false,
        ]);
    }

}
