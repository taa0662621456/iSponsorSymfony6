<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\TranslatebleTrait;

class TranslatebleTraitTest extends TestCase
{
    public function testTranslation(): void
    {
        $obj = new class { use TranslatebleTrait; };
        $obj->setTranslation('en', 'Hello');
        $this->assertEquals('Hello', $obj->getTranslation('en'));
    }
}
