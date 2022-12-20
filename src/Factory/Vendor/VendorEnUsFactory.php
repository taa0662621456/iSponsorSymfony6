<?php

namespace App\Factory\Vendor;

use App\Entity\Vendor\VendorEnUS;

class VendorEnUsFactory
{
    public function __invoke(): VendorEnUs
    {
        return new VendorEnUs();
    }


    public static function create(): VendorEnUs
    {
        return new VendorEnUs();
    }

}
