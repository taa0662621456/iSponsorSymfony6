<?php

namespace Helpers;

use Faker\Factory;
use App\Entity\Vendor\Vendor;

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
