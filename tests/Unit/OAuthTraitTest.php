<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\OAuthTrait;

class OAuthTraitTest extends TestCase
{
    public function testTokenLifecycle(): void
    {
        $obj = new class { use OAuthTrait; };
        $obj->setAccessToken('tok123');
        $this->assertEquals('tok123', $obj->getAccessToken());
    }
}
