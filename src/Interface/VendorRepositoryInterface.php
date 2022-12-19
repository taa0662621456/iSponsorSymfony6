<?php

namespace App\Interface;

use App\Entity\Vendor\Vendor;

interface VendorRepositoryInterface
{
    public function findOneByEmail(string $email): Vendor;

}
