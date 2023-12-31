<?php

namespace App\DataFixtures\Featured;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class FeaturedFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'firstTitle' => 'NA',
            'lastTitle' => 'NA',
        ];

        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 26;
    }
}
