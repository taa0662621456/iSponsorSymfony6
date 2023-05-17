<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectAttachmentInterface;

#[ORM\Entity]
class ProjectAttachment extends ObjectSuperEntity implements ObjectInterface, ProjectAttachmentInterface
{
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectAttachmentProject;

}
