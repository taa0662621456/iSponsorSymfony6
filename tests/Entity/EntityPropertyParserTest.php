<?php

namespace App\Tests\Entity;

use App\DataTransferObject\ObjectProps;
use App\Service\Entity\EntityPropertyParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class EntityPropertyParserTest extends TestCase
{
    private EntityPropertyParser $parser;

    protected function setUp(): void
    {
        $this->parser = new EntityPropertyParser();
    }

    public function testParseValidRequest(): void
    {
        $request = new Request([], [], [
            'entity' => 'TestEntity',
            'subEntity' => 'TestSubEntity',
            '_route' => 'crud_action',
        ]);

        $props = $this->parser->parseProperties($request);

        $this->assertInstanceOf(ObjectProps::class, $props);
        $this->assertSame('TestEntity', $props->entity);
        $this->assertSame('TestSubEntity', $props->subEntity);
        $this->assertSame('crud_action', $props->crudAction);
    }

    public function testParseInvalidRequest(): void
    {
        $request = new Request([], [], []); // Нет данных

        $props = $this->parser->parseProperties($request);

        $this->assertNull($props); // Ожидаем null
    }
}
