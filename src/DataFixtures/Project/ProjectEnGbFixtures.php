<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectEnGb;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectEnGbFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $project = $this->getReference('project_1');

        $en = new ProjectEnGb();
        $en->setFirstTitle('Green Energy Initiative');
        $en->setProjectDesc('A project for renewable energy development');
        $en->setProject($project);

        $manager->persist($en);
        $this->addReference('projectEnGb_1', $en);

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 50; }
}