<?php

namespace Helpers;

use App\Entity\Vendor\VendorSecurity;
use Faker\Factory;


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
