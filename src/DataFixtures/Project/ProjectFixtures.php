<?php

namespace App\DataFixtures\Project;

use Faker\Factory;

use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends DataFixtures
{
    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
            'projectType' => $this->getReference('ProjectTypeFixtures_'.$i),
            'projectEnGb' => $this->getReference('ProjectEnGbFixtures_'.$i),
            'projectAttachment' => $this->getReference('ProjectAttachmentFixtures_'.$i),
            'projectCategory' => $this->getReference('CategoryFixtures_'.$i),
            'projectTag' => $this->getReference('ProjectTagFixtures_'.$i),
            'projectReview' => $this->getReference('ProjectReviewFixtures_'.$i),
        ];

        parent::load($manager, $property, $n);
    }

    public function getOrder(): int
    {
        return 16;
    }
}
