<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\Project;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $type = $this->getReference('projectType_Grant');

        $project = new Project();
        $project->setBudget(500000);
        $project->setType($type);

        $manager->persist($project);
        $this->addReference('project_1', $project);

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 30; }
}
