<?php

declare(strict_types=1);

namespace App\DataFixtures\Project;


use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class ProjectTagFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(),
            'lastTitle' => fn($faker, $i) => $faker->realText(7000),
        ];

        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 14;
    }
}
