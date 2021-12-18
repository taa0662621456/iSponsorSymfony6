<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class OrdersStatusFixtures extends Fixture implements DependentFixtureInterface
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
        return array(
            VendorsFixtures::class,
        );
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 5;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['status'];
    }
}
