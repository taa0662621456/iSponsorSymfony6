<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectAttachment;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectAttachmentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $project = $this->getReference('project_1');

        $attachment = new ProjectAttachment();
        $attachment->setFilePath('files/green_energy.pdf');
        $attachment->setProject($project);

        $manager->persist($attachment);
        $this->addReference('projectAttachment_1', $attachment);

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 40; }
}
