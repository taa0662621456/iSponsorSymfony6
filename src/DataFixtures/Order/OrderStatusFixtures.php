<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\OrderStatus;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class OrderStatusFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['pending', 'paid', 'shipped', 'cancelled'] as $i => $status) {
            $os = new OrderStatus();
            $os->setCode($status);

            $manager->persist($os);
            $this->addReference('orderStatus_' . $status, $os);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'order'; }
    public static function getPriority(): int { return 10; } // before orders
}