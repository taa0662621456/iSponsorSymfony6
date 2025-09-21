<?php

namespace App\Tests\Entity;

use App\Service\Entity\EntityTemplate;
use PHPUnit\Framework\TestCase;

class EntityTemplateTest extends TestCase
{
    private EntityTemplate $template;

    protected function setUp(): void
    {
        $this->template = new EntityTemplate();
    }

    public function testGetEntityTemplatePath(): void
    {
        $path = $this->template->getEntityTemplatePath('user', 'create');
        $this->assertSame('user/user/create.html.twig', $path);

        $defaultPath = $this->template->getEntityTemplatePath('user');
        $this->assertSame('user/user/index.html.twig', $defaultPath);
    }
}

