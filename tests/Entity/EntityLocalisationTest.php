<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityLocalisation;
use PHPUnit\Framework\TestCase;

class EntityLocalisationTest extends TestCase
{
    private EntityLocalisation $localisation;

    protected function setUp(): void
    {
        $this->localisation = new EntityLocalisation();
    }

    public function testGetLocalizedEntityNamespace(): void
    {
        $namespace = $this->localisation->getLocalizedEntityNamespace('App\\Entity\\User', 'en');
        $this->assertSame('App\\Entity\\UserEn', $namespace);
    }

    public function testGetLocalizedTemplatePath(): void
    {
        $path = $this->localisation->getLocalizedTemplatePath('order', 'ru', 'create');
        $this->assertSame('order/create/ru.ru.twig', $path);
    }
}

