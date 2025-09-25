<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductTag;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductTagFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['new', 'popular', 'discount'] as $tag) {
            $pt = new ProductTag();
            $pt->setName($tag);

            $manager->persist($pt);
            $this->addReference('productTag_' . $tag, $pt);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 20; } // after type, before products
}
