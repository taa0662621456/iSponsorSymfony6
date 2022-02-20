<?php

namespace App\DataFixtures;

use App\Entity\Order\Order;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderStatus;
use App\Entity\Product\ProductEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
		$productsEnGbRepository = $manager->getRepository(ProductEnGb::class);
		$productsCount = count($productsEnGbRepository->findAll());

		$status = $manager->getRepository(OrderStatus::class)->findAll();

		for ($p = 1; $p <= random_int(1, $productsCount); $p++) {

			$orders = new Order();

			$orders->setOrderStatus($status[array_rand($status)]);

			$orders->setOrderIpAddress('127.0.0.1');

			for ($i = 1; $i <= random_int(1, $productsCount); $i++) {

				$orderItems = new OrderItem();

				$orderItems->setItemId($i);
				$orderItems->setItemName('item ' . $i);

				$orders->addOrderItem($orderItems);
				$manager->persist($orderItems);
			}


			$manager->persist($orders);
			$manager->flush();
		}
	}

	public function getDependencies (): array
    {
		return array(
			OrdersStatusFixtures::class,
			ProductsFixtures::class,
		);
	}

	public function getOrder(): int
    {
		return 6;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['orders'];
	}
}
