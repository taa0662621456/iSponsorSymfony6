<?php

namespace App\DataFixtures\Category;

use App\Entity\Category\CategoryAttachment;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryAttachmentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $category = $this->getReference('category_0'); // Electronics

        $att = new CategoryAttachment();
        $att->setFilePath('images/category_electronics.png');
        $att->setCategory($category);

        $manager->persist($att);
        $this->addReference('categoryAttachment_1', $att);

        $manager->flush();
    }

    public static function getGroup(): string { return 'category'; }
    public static function getPriority(): int { return 20; }
}