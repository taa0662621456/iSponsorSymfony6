<?php

namespace App\Interface;

use App\Entity\Project\Project;
use Doctrine\Common\Collections\Collection;

interface ProjectTypeInterface
{
    # OneToMany
    public function getProjectType(): Collection;
    public function addProjectType(Project $project): self;
    public function removeProjectType(Project $project): self;
}
