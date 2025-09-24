<?php

namespace App\DataFixtures\Featured;

use App\Entity\Featured\Featured;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class FeaturedFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $item = new Featured();
        $item->setTitle('Top Deal of the Week');
        $item->setPosition(1);

        $manager->persist($item);
        $this->addReference('featured_1', $item);

        $manager->flush();
    }

    public static function getGroup(): string { return 'featured'; }
    public static function getPriority(): int { return 10; }
}