<?php

namespace App\RepositoryInterface\Vendor;

use App\RepositoryInterface\EntityRepositoryInterface;

use Symfony\Component\Security\Core\User\UserInterface;

interface VendorRepositoryInterface extends EntityRepositoryInterface
{
    public function findOneByEmail(string $email): ?UserInterface;

}
