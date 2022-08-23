<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStorage;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderStatus;
use App\Entity\Product\ProductEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_COLLECTION = 'orderCollection';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $orderCollection = new ArrayCollection();

		$productsEnGbRepository = $manager->getRepository(ProductEnGb::class)->findAll();
		$orderStatusesRepository = $manager->getRepository(OrderStatus::class)->findAll();

		for ($p = 1; $p <= random_int(1, count($productsEnGbRepository)); $p++) {

			$order = new OrderStorage();

			$order->setOrderStatus($orderStatusesRepository[array_rand($orderStatusesRepository)]);

			$order->setOrderIpAddress('127.0.0.1');

			for ($i = 1; $i <= random_int(1, count($productsEnGbRepository)); $i++) {

				$orderItems = new OrderItem();

				$orderItems->setItemId($i);
				$orderItems->setItemName('item ' . $i);

				$order->addOrderItem($orderItems);
				$manager->persist($orderItems);
			}


			$manager->persist($order);
			$manager->flush();

            $orderCollection->add($order);
		}

        $this->addReference(self::ORDER_COLLECTION, $orderCollection);
	}

	public function getDependencies (): array
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
            OrderStatusFixtures::class,
            ProjectFixtures::class,
            ProductFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 12;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['order'];
	}
}
