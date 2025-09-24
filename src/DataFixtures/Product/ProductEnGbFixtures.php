<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductEnGb;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductEnGbFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $product = $this->getReference('product_1');

        $en = new ProductEnGb();
        $en->setName('Smart TV');
        $en->setDescription('High-definition Smart TV with streaming apps');
        $en->setProduct($product);

        $manager->persist($en);
        $this->addReference('productEnGb_1', $en);

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 50; }
}