<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public const PRODUCT_REF = 'test_product';

    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        if (method_exists($product, 'setName')) {
            $product->setName('Test Product');
        }
        if (method_exists($product, 'setCode')) {
            $product->setCode('TEST123');
        }
        $manager->persist($product);
        $this->addReference(self::PRODUCT_REF, $product);
        $manager->flush();
    }
}
