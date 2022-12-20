<?php

namespace App\Factory\Vendor;

use App\Entity\Vendor\VendorSecurity;

class VendorSecurityFactory
{
    public function __invoke(): VendorSecurity
    {
        return new VendorSecurity();
    }


    public static function create(): VendorSecurity
    {
        return new VendorSecurity();
    }

}
