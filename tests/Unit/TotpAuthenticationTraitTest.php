<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\TotpAuthenticationTrait;

class TotpAuthenticationTraitTest extends TestCase
{
    public function testTotpSetter(): void
    {
        $obj = new class { use TotpAuthenticationTrait; };
        $obj->setTotpSecret('SECRET');
        $this->assertEquals('SECRET', $obj->getTotpSecret());
    }
}
