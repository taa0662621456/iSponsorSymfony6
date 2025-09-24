<?php

namespace App\DataFixtures\Shipment;

use App\Entity\Shipment\ShipmentMethod;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ShipmentMethodFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $method = new ShipmentMethod();
        $method->setName('Standard Delivery');
        $manager->persist($method);
        $this->addReference('shipmentMethod_standard', $method);

        $manager->flush();
    }

    public static function getGroup(): string { return 'shipment'; }
    public static function getPriority(): int { return 10; }
}
