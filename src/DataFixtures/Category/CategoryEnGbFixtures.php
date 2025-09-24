<?php

namespace App\DataFixtures\Category;

use App\Entity\Category\CategoryEnGb;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryEnGbFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $category = $this->getReference('category_0');

        $en = new CategoryEnGb();
        $en->setName('Electronics');
        $en->setDescription('Category for electronic products');
        $en->setCategory($category);

        $manager->persist($en);
        $this->addReference('categoryEnGb_1', $en);

        $manager->flush();
    }

    public static function getGroup(): string { return 'category'; }
    public static function getPriority(): int { return 30; }
}