<?php

namespace App\DTO\Project;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProjectAttachmentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
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
