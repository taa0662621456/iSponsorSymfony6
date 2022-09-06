<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_STATUS_COLLECTION = 'orderStatusCollection';

    public function load(ObjectManager $manager)
    {
        $orderStatusMap = [
          'New' => 'N',
          'Depend' => 'D',
          'Canceled' => 'C',
          'Shiped' => 'S',
          'Delivered' => 'D'
        ];
        $ordersStatusCollection = new ArrayCollection();

        for ($p = 0; $p <= count($orderStatusMap); $p++) {

            $ordersStatus = new OrderStatus();

            //применить многомерній массив или карту
            $ordersStatus->setOrderStatusCode('N');
            $ordersStatus->setOrderStatusName('New ' . $p);
            $ordersStatus->setOrdering($p);

            $manager->persist($ordersStatus);
            $manager->flush();

            $ordersStatusCollection->add($ordersStatus);
        }

        $this->addReference(self::ORDER_STATUS_COLLECTION, $ordersStatusCollection);
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
