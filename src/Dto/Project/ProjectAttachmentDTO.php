<?php

namespace App\Dto\Project;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProjectAttachmentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Project $projectAttachmentProjectDTO;

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
