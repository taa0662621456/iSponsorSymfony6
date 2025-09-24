<?php

namespace App\DataFixtures\Product;

use App\Entity\Order\OrderItem;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class OrderItemFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $product = $this->getReference('product_1');

        $item = new OrderItem();
        $item->setProduct($product);
        $item->setQuantity(2);

        $manager->persist($item);
        $this->addReference('orderItem_1', $item);

        $manager->flush();
    }

    public static function getGroup(): string { return 'order'; }
    public static function getPriority(): int { return 20; }
}
