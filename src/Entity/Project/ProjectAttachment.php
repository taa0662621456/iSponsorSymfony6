<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectAttachmentInterface;

#[ORM\Entity]
class ProjectAttachment extends ObjectSuperEntity implements ObjectInterface, ProjectAttachmentInterface
{
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectAttachmentProject;

    // ManyToOne
    public function getProjectAttachmentProject(): Project
    {
        return $this->projectAttachmentProject;
    }

    public function setProjectAttachmentProject(Project $attachment): void
    {
        $this->projectAttachmentProject = $attachment;
    }
}
