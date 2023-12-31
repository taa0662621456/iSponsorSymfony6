<?php

namespace Vendor;

use PHPUnit\Framework\TestCase;
use App\Factory\Vendor\VendorEnUsFixtureFactory;

class VendorEnTest extends TestCase
{
    public function vendorTest()
    {
        $vendorEn = VendorEnUsFixtureFactory::createVendorEnUsEntity('Mike', 'Douglas');

        $this->assertEquals('test firstTitle', $vendorEn->getFirstTitle());
        $this->assertEquals('test lastTitle', $vendorEn->getLastTitle());
        $this->assertNotNull($vendorEn->getCreatedAt());
    }
}
