<?php

namespace App\Factory;

use App\Entity\Vendor\Vendor;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Vendor>
 */
final class VendorFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->company(),
            'email' => self::faker()->unique()->companyEmail(),
            'roles' => ['ROLE_CUSTOMER'],
        ];
    }

    protected static function getClass(): string
    {
        return Vendor::class;
    }

    public function asAdmin(): self
    {
        return $this->addState(['roles' => ['ROLE_ADMIN']]);
    }

    public function asManager(): self
    {
        return $this->addState(['roles' => ['ROLE_MANAGER']]);
    }

    public function asCustomer(): self
    {
        return $this->addState(['roles' => ['ROLE_CUSTOMER']]);
    }
}
