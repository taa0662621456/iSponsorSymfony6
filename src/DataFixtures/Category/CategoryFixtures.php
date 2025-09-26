<?php

namespace App\DataFixtures\Category;

use App\Entity\Category\Category;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['Electronics', 'Furniture', 'Books'] as $i => $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'category'; }
    public static function getPriority(): int { return 10; }
}
