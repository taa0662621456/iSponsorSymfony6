<?php

namespace App\Entity\Project;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectAttachmentInterface;

#[ORM\Entity]
class ProjectAttachment extends RootEntity implements ObjectInterface, ProjectAttachmentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'project')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectAttachmentProject;
}
