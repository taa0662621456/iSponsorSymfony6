<?php

namespace App\Interface\Vendor;

use Symfony\Component\Security\Core\User\UserInterface;

interface VendorRepositoryInterface extends \App\Interface\RepositoryInterface
{
    public function findOneByEmail(string $email): ?UserInterface;

}
