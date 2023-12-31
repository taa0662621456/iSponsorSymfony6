<?php

namespace App\DataFixtures\Project;


use App\DataFixtures\DataFixtures;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(50),
            'lastTitle' => fn($faker, $i) => $faker->realText(2500),
            'projectType' => fn($faker, $i) => $this->getReference('ProjectTypeFixtures_' . $i),
            'projectEnGb' => fn($faker, $i) => $this->getReference('ProjectEnGbFixtures_' . $i),
            'projectAttachment' => fn($faker, $i) => $this->getReference('ProjectAttachmentFixtures_' . $i),
            'projectCategory' => fn($faker, $i) => $this->getReference('CategoryFixtures_' . $i),
            'projectTag' => fn($faker, $i) => $this->getReference('ProjectTagFixtures_' . $i),
            'projectReview' => fn($faker, $i) => $this->getReference('ProjectReviewFixtures_' . $i),
        ];

        parent::load($manager, $property);
    }

    public function getOrder(): int
    {
        return 16;
    }

}
