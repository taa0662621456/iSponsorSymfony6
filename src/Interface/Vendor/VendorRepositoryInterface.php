<?php

namespace App\Interface\Vendor;

use Symfony\Component\Security\Core\User\UserInterface;

interface VendorRepositoryInterface
{
    public function findOneByEmail(string $email): ?UserInterface;

}
