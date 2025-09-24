<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\Product;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        // Example: use ProductType from earlier fixtures
        $type = $this->getReference('productType_Electronics');

        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product->setFirstTitle('Product ' . $i);
            $product->setPrice(mt_rand(100, 1000));
            $product->setType($type);

            $manager->persist($product);
            $this->addReference('product_' . $i, $product);
        }

        $manager->flush();
    }

    public static function getGroup(): string
    {
        return 'product';
    }

    public static function getPriority(): int
    {
        // Main entity, comes after type & tags
        return 30;
    }
}