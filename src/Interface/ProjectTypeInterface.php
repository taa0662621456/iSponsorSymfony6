<?php

namespace App\Interface;

use App\Entity\Project\Project;

interface ProjectTypeInterface
{
    public function getProjectType(): Project;

    public function setProjectType(Project $projectType): void;

}
