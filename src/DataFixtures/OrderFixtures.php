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
use Faker\Factory;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_COLLECTION = 'orderCollection';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $orderStatus = array_rand((array)$this->getReference(OrderStatusFixtures::ORDER_STATUS_COLLECTION));
        $orderVendor = array_rand((array)$this->getReference(VendorFixtures::VENDOR_COLLECTION));
        $orderItem = $this->getReference(ProductFixtures::PRODUCT_COLLECTION);
        $orderCollection = new ArrayCollection();

		$productsEnGbRepository = $manager->getRepository(ProductEnGb::class)->findAll();
//		$orderStatusesRepository = $manager->getRepository(OrderStatus::class)->findAll();

		for ($p = 1; $p <= random_int(1, count($productsEnGbRepository)); $p++) {

			$order = new OrderStorage();

//			$order->setOrderStatus($orderStatusesRepository[array_rand($orderStatusesRepository)]);
			$order->setOrderStatus($orderStatus);
            $order->setOrderVendor($orderVendor);
            $order->addOrderItem($orderItem);
			$order->setOrderIpAddress($faker->ipv4);

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
