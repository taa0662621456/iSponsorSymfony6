<?php

namespace App\Interface\Vendor;

use App\Entity\Vendor\Vendor;

interface VendorRepositoryInterface
{
    public function findOneByEmail(string $email): Vendor;

}