<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\ReviewTrait;

class ReviewTraitTest extends TestCase
{
    public function testRating(): void
    {
        $obj = new class { use ReviewTrait; };
        $obj->setRating(5);
        $this->assertEquals(5, $obj->getRating());
    }
}
