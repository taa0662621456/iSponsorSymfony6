<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class VendorDocumentAttachmentFixtures extends DataFixtures
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(),
            'lastTitle' => fn($faker, $i) => $faker->realText(7000),
        ];

        parent::load($manager, $property);
    }
}
