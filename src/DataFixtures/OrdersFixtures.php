<?php

namespace App\DataFixtures;

use App\Entity\Order\Orders;
use App\Entity\Order\OrdersItems;
use App\Entity\Order\OrdersStatus;
use App\Entity\Product\ProductsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
		//$productsRepository = $manager->getRepository(Products::class);
		$productsEnGbRepository = $manager->getRepository(ProductsEnGb::class);
		$products = $productsEnGbRepository->findAll();
		$productsCount = count($products);

		for ($p = 1; $p <= rand(1, $productsCount); $p++) {

			$orders = new Orders();
			$orderStatus = new OrdersStatus();

			try {
				$orders->setUuid(Uuid::uuid4());
				$orders->setSlug(Uuid::uuid4());
			} catch (Exception $e) {
			}

			$orders->setOrderIpAddress('127.0.0.1');
			$orders->setOrderStatus($orders);

			$orderStatus->setOrderStatusCode('N');

			for ($i = 1; $i <= rand(1, $productsCount); $i++) {

				//$productCurrent = $productsRepository->find($productRand);
				//$productEnGbCurrent = $productsEnGbRepository->find($i);
				//$productEnGbCurrentName = $productEnGbCurrent->getProductName();

				$orderItems = new OrdersItems();

				$orderItems->setItemId($i);
				$orderItems->setItemName('item ' . $i);

				$manager->persist($orderItems);
			}

			$manager->persist($orders);
			$manager->persist($orderStatus);
			$manager->flush();
		}
    }

	public function getDependencies ()
	{
		return array (
			ProductsFixtures::class,
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
		return ['orders'];
	}
}
