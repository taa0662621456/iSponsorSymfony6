<?php

namespace App\Factory;

use App\Entity\Vendor\VendorSecurity;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<VendorSecurity>
 */
final class VendorSecurityFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'password' => 'test123', // consider hashing in real app
        ];
    }

    protected static function getClass(): string
    {
        return VendorSecurity::class;
    }
}
