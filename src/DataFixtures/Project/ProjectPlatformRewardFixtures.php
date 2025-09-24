<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectPlatformReward;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectPlatformRewardFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $project = $this->getReference('project_1');

        $reward = new ProjectPlatformReward();
        $reward->setTitle('Supporter Badge');
        $reward->setDescription('Special badge for early supporters');
        $reward->setProject($project);

        $manager->persist($reward);
        $this->addReference('projectReward_1', $reward);

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 70; }
}