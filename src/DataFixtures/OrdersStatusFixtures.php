<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Order\OrdersStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class OrdersStatusFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 5; $p++) {

            $ordersStatus = new OrdersStatus();
            $slug = new UuidEncoder();

            try {
                $uuid = Uuid::uuid4();
                $ordersStatus->setUuid($uuid);
                $ordersStatus->setSlug($slug->encode($uuid));
            } catch (Exception $e) {
            }

            $ordersStatus->setOrderStatusCode('N');
            $ordersStatus->setOrderStatusName('New ' . $p);
            $ordersStatus->setOrdering($p);

            $manager->persist($ordersStatus);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            VendorsFixtures::class,
        );
    }

    /**
     * @return int
     */
    public function getOrder()
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
