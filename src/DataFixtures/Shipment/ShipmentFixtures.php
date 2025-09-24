<?php

namespace App\DataFixtures\Shipment;

use App\Entity\Shipment\ShipmentCategory;
use App\Entity\Shipment\ShipmentMethod;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ShipmentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $method = new ShipmentMethod();
        $method->setName('Standard');
        $manager->persist($method);

        $category = new ShipmentCategory();
        $category->setName('Domestic');
        $manager->persist($category);

        $this->addReference('shipmentMethod_standard', $method);
        $this->addReference('shipmentCategory_domestic', $category);

        $manager->flush();
    }

    public static function getGroup(): string { return 'shipment'; }
    public static function getPriority(): int { return 10; }
}
