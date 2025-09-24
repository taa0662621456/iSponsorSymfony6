<?php
namespace App\Service\Security;

use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityPasswordMigrator
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher) {}

    public function upgradeHashIfNeeded(VendorSecurity $user, string $plain): void
    {
        if ($this->hasher->needsRehash($user)) {
            $user->setPassword($this->hasher->hashPassword($user, $plain));
        }
    }
}