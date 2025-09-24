<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\MetaTrait;

class MetaTraitTest extends TestCase
{
    public function testMetaFields(): void
    {
        $obj = new class { use MetaTrait; };
        $obj->setMetaTitle('Title')->setMetaDescription('Desc')->setMetaKeywords('a,b,c');
        $this->assertEquals('Title', $obj->getMetaTitle());
        $this->assertEquals('Desc', $obj->getMetaDescription());
        $this->assertEquals('a,b,c', $obj->getMetaKeywords());
    }
}
