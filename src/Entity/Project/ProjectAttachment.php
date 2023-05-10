<?php

namespace App\Entity\Project;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectAttachmentInterface;
use App\Repository\Project\ProjectAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_attachment')]
#[ORM\Index(columns: ['slug'], name: 'project_attachment_idx')]
#[ORM\Entity(repositoryClass: ProjectAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
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
