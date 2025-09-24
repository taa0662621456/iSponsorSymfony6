<?php

namespace App\DataFixtures\Shipment;

use App\Entity\Shipment\ShipmentCategory;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ShipmentCategoryFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $cat = new ShipmentCategory();
        $cat->setName('Domestic');
        $manager->persist($cat);
        $this->addReference('shipmentCategory_domestic', $cat);

        $manager->flush();
    }

    public static function getGroup(): string { return 'shipment'; }
    public static function getPriority(): int { return 15; }
}
