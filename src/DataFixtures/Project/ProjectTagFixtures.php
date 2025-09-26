<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectTag;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectTagFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['sustainability', 'education', 'healthcare'] as $tag) {
            $tagEntity = new ProjectTag();
            $tagEntity->setName($tag);

            $manager->persist($tagEntity);
            $this->addReference('projectTag_' . $tag, $tagEntity);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 20; } // after type, before project
}
