<?php

namespace Vendor;


use App\Factory\Vendor\VendorEnUsFixtureFactory;
use PHPUnit\Framework\TestCase;

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
