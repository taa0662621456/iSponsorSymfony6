<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductOption;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductOptionFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $option = new ProductOption();
        $option->setName('Size');
        $manager->persist($option);
        $this->addReference('productOption_size', $option);

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 16; }
}