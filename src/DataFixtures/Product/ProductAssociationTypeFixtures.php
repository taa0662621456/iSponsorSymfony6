<?php

namespace App\DataFixtures\Product;

use App\Form\Product\ProductBundle\ProductAssociationType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProductAssociationTypeFixtures extends Fixture
{
    public const DEFAULT_CODE = 'similar_products';

    public function load(ObjectManager $manager): void
    {
        $associationType = new ProductAssociationType();
        $associationType->setCode(self::DEFAULT_CODE);
        $associationType->setName('Similar Products');

        $manager->persist($associationType);
        $manager->flush();

        $this->addReference(self::DEFAULT_CODE, $associationType);
    }
}
