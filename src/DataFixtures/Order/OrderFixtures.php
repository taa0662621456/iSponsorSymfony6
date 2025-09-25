<?php

namespace App\DataFixtures\Order;

use App\Entity\Order\OrderStorage;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class OrderFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        // Fetch sample references (assuming UserFixtures and ProductFixtures already set them)
        $user = $this->getReference('user_customer_1');
        $product1 = $this->getReference('product_1');
        $product2 = $this->getReference('product_2');

        for ($i = 1; $i <= 5; $i++) {
            $order = new OrderStorage();
            $order->setUser($user);
            $order->addProduct($product1);
            $order->addProduct($product2);
            $order->setTotal($product1->getPrice() + $product2->getPrice());

            $manager->persist($order);
            $this->addReference('order_' . $i, $order);
        }

        $manager->flush();
    }

    public static function getGroup(): string
    {
        return 'order';
    }

    public static function getPriority(): int
    {
        // Always last, depends on core + catalog
        return 100;
    }
}
