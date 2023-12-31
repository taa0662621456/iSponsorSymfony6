<?php

namespace Helpers;

use Faker\Factory;
use App\Entity\Vendor\VendorSecurity;

trait VendorSecurityEntityCreator
{
    public function makeVendorSecurityEntity(): VendorSecurity
    {
        $faker = Factory::create();

        $vendorSecurity = new VendorSecurity();
        $vendorSecurity->setEmail($faker->email);
        $vendorSecurity->setUsername($faker->firstName);
        $vendorSecurity->setPassword($faker->lastName);
        $vendorSecurity->setPhone($faker->lastName);
        $vendorSecurity->setRoles(['ROLE_VENDOR']);

        return $vendorSecurity;
    }
}
