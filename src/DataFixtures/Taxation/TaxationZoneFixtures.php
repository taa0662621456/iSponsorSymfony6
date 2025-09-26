<?php

namespace App\DataFixtures\Taxation;

use App\Entity\Taxation\TaxationZone;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class TaxationZoneFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $zone = new TaxationZone();
        $zone->setName('US');
        $manager->persist($zone);
        $this->addReference('taxZone_us', $zone);

        $manager->flush();
    }

    public static function getGroup(): string { return 'taxation'; }
    public static function getPriority(): int { return 10; }
}

