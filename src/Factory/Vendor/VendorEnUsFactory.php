<?php

namespace App\Factory\Vendor;

use App\Entity\Vendor\VendorEnUS;

class VendorEnUsFactory
{
    public function __invoke(): VendorEnUs
    {
        return new VendorEnUs();
    }

    public static function createVendorEnUsEntity(string $firstTitle, string $lastTitle): VendorEnUS
    {
        $vendorEnUS = new VendorEnUS();

        $vendorEnUS->setFirstTitle($firstTitle);
        $vendorEnUS->setLastTitle($lastTitle);

        return $vendorEnUS;
    }

    public static function create(): VendorEnUs
    {
        return new VendorEnUs();
    }

}
