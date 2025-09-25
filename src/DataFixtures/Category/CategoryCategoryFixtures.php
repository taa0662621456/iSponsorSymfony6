<?php

namespace App\DataFixtures\Category;

use App\Entity\Category\Category;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryCategoryFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $parent = $this->getReference('category_0'); // Electronics
        $child = $this->getReference('category_1');  // Furniture

        $rel = new Category();
        $rel->setParent($parent);
        $rel->setChild($child);

        $manager->persist($rel);
        $this->addReference('categoryCategory_1', $rel);

        $manager->flush();
    }

    public static function getGroup(): string { return 'category'; }
    public static function getPriority(): int { return 40; }
}
