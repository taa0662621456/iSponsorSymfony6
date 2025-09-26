<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductType;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductTypeFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['Electronics', 'Furniture', 'Software'] as $name) {
            $type = new ProductType();
            $type->setName($name);

            $manager->persist($type);
            $this->addReference('productType_' . $name, $type);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 10; }
}
