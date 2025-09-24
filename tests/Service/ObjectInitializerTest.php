<?php

namespace App\Tests\Service;

use App\Service\ObjectInitializer;
use PHPUnit\Framework\TestCase;

class ObjectInitializerTest extends TestCase
{
    public function testGetEntityClassReturnsString(): void
    {
        $initializer = new ObjectInitializer();
        $this->assertIsString($initializer->getEntityClass('Vendor'));
    }

    public function testGetTemplatePathReturnsString(): void
    {
        $initializer = new ObjectInitializer();
        $this->assertIsString($initializer->getTemplatePath('Vendor'));
    }

    public function testGetCrudActionReturnsString(): void
    {
        $initializer = new ObjectInitializer();
        $this->assertEquals('edit', $initializer->getCrudAction('edit'));
    }

    public function testGetLocaleFilterReturnsArray(): void
    {
        $initializer = new ObjectInitializer();
        $this->assertIsArray($initializer->getLocaleFilter());
    }
}
