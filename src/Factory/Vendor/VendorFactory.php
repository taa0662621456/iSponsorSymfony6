<?php

namespace App\Factory\Vendor;

use App\Entity\Vendor\Vendor;
use App\Interface\Vendor\VendorFactoryInterface;

class VendorFactory implements VendorFactoryInterface
{
    public function __invoke(): Vendor
    {
        return new Vendor();
    }


    public static function create(): Vendor
    {
        return new Vendor();
    }

}
