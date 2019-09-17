<?php

namespace App\DataFixtures;

use App\Entity\Order\Orders;
use App\Entity\Order\OrdersItems;
use App\Entity\Order\OrdersStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OrdersFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
    	// Parent categories
    	for ($p=1; $p <= 26; $p++) {
			$orders = new Orders();
			//$orderItems = new OrdersItems();
			//$orderStatus = new OrdersStatus();

			$orders->setorderIpAddress('127.0.0.1');

			$manager->persist($orders);
			//$manager->persist($orderItems);
			//$manager->persist($orderStatus);
			$manager->flush();
		}
    }


	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['orders'];
	}
}
