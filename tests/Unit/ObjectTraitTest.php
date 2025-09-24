<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\ObjectTrait;

class ObjectTraitTest extends TestCase
{
    public function testTitleSlug(): void
    {
        $obj = new class { use ObjectTrait; };
        $obj->setTitle('Hello');
        $this->assertEquals('Hello', $obj->getTitle());
        $this->assertNotEmpty($obj->getSlug());
    }
}
