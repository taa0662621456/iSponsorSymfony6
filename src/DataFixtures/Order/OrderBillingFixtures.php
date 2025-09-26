<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\OrderBilling;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class OrderBillingFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $billing = new OrderBilling();
        $billing->setAddressLine('123 Main Street');
        $manager->persist($billing);
        $this->addReference('orderBilling_1', $billing);

        $manager->flush();
    }

    public static function getGroup(): string { return 'order'; }
    public static function getPriority(): int { return 30; }
}

