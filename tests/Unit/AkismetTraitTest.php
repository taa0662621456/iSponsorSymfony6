<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\AkismetTrait;

class AkismetTraitTest extends TestCase
{
    public function testSpamToggle(): void
    {
        $obj = new class { use AkismetTrait; };
        $obj->markAsSpam();
        $this->assertTrue($obj->isSpam());
        $obj->unmarkSpam();
        $this->assertFalse($obj->isSpam());
    }
}
