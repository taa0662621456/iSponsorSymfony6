<?php

namespace App\DataFixtures\Category;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 10;
    }
}
