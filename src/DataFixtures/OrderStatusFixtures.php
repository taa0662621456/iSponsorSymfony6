<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 5; $p++) {

            $ordersStatus = new OrderStatus();

            $ordersStatus->setOrderStatusCode('N');
            $ordersStatus->setOrderStatusName('New ' . $p);
            $ordersStatus->setOrdering($p);

            $manager->persist($ordersStatus);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
            ReviewProductFixtures::class,
            CategoryAttachmentFixtures::class,
            ProjectTypeFixtures::class,
            ProjectAttachmentFixtures::class,
            ProjectTagFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 9;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['order'];
    }
}
