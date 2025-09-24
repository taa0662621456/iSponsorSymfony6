<?php

namespace App\Factory\Vendor;

use App\Entity\Vendor\Vendor;

class VendorFactory
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