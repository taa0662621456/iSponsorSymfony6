<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectType;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectTypeFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['Grant', 'Donation', 'Crowdfunding'] as $name) {
            $type = new ProjectType();
            $type->setName($name);

            $manager->persist($type);
            $this->addReference('projectType_' . $name, $type);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 10; }
}