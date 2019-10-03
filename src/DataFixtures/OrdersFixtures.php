<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Order\Orders;
use App\Entity\Order\OrdersItems;
use App\Entity\Order\OrdersStatus;
use App\Entity\Product\ProductsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
		$productsEnGbRepository = $manager->getRepository(ProductsEnGb::class);
		$productsCount = count($productsEnGbRepository->findAll());

		$ordersStatusCount = count($manager->getRepository(OrdersStatus::class)->findAll());
		$randStatus = $manager->getRepository(OrdersStatus::class)->find(rand(1, $ordersStatusCount));

		for ($p = 1; $p <= rand(1, $productsCount); $p++) {

			$orders = new Orders();
			$slug = new UuidEncoder();

			try {
				$uuid = Uuid::uuid4();
				$orders->setUuid($uuid);
				$orders->setSlug($slug->encode($uuid));
			} catch (Exception $e) {
			}

			$orders->setOrderStatus($randStatus[array_rand((array)$randStatus)]);

			$orders->setOrderIpAddress('127.0.0.1');

			for ($i = 1; $i <= rand(1, $productsCount); $i++) {

				$orderItems = new OrdersItems();

				$orderItems->setItemId($i);
				$orderItems->setItemName('item ' . $i);

				$orders->addOrderItem($orderItems);
				$manager->persist($orderItems);
			}


			$manager->persist($orders);
			$manager->flush();
		}
	}

	public function getDependencies ()
	{
		return array(
			OrdersStatusFixtures::class,
			ProductsFixtures::class,
		);
	}

	/**
	 * @return int
	 */
	public function getOrder()
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
