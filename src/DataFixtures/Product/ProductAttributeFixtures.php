<?php

namespace App\DataFixtures\Vendor;


use App\Entity\Product\ProductAttribute;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductAttributeFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $attribute = new ProductAttribute();
        $attribute->setName('Color');
        $manager->persist($attribute);
        $this->addReference('productAttribute_color', $attribute);

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 15; }
}
