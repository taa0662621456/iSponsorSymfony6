<?php

namespace App\DataFixtures\Vendor;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use function _PHPStan_39fe102d2\RingCentral\Psr7\str;

final class VendorSecurityFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'email' => fn($faker, $i) => $faker->unique()->email(),
            'password' => fn($faker, $i) => $faker->password(8, 12)
        ];

        parent::load($manager, $property);
    }
}
