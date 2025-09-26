<?php

namespace Helpers;

use App\Entity\Vendor\Vendor;
use Faker\Factory;


trait VendorEntityCreator
{
    public function makeVendorEntity(): Vendor
    {

        $faker = Factory::create();

        $vendor = new Vendor();
        $vendor->setLocale($faker->email);
        $vendor->setIsActive(true);
        $vendor->setPublished(true);

        return $vendor;
    }
}
