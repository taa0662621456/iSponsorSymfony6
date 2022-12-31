<?php

namespace App\DataFixtures;

use App\Entity\Order\OrderStorage;
use App\Entity\Order\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;

final class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();


		for ($i = 1; $i <= 15; $i++) {

			$order = new OrderStorage();

            $orderStatus = $this->getReference('orderStatus_' . $i);


			$order->setOrderStatus($orderStatus);
//            $order->setOrderVendor($i);
//            $order->addOrderItem($orderItem);
			$order->setOrderIpAddress($faker->ipv4);

			for ($i = 1; $i <= 25; $i++) {

				$orderItem = new OrderItem();

				$orderItem->setItemId($i);
				$orderItem->setItemName('item_' . $i);

				$order->addOrderItem($orderItem);

				$manager->persist($orderItem);

                $this->setReference('orderItem_' . $i, $orderItem);
			}

			$manager->persist($order);

            $this->setReference('order_' . $i, $order);
        }
        $manager->flush();

	}

	public function getDependencies (): array
    {
		return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,
            #
            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectPlatformRewardFixtures::class,
            ProjectFixtures::class,
            #
            ProductAttachmentFixtures::class,
            ProductReviewFixtures::class,
            ProductTagFixtures::class,
            ProductTypeFixtures::class,
            ProductEnGbFixtures::class,
            ProductFixtures::class,
            #
            OrderStatusFixtures::class,

        ];
	}

	public function getOrder(): int
    {
		return 25;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['order'];
	}
}
