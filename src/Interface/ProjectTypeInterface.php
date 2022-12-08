<?php

namespace App\Interface;

use App\Entity\Project\Project;
use Doctrine\Common\Collections\Collection;

interface ProjectTypeInterface
{
    # OneToMany
    public function getProjectTypeProject(): Collection;
    public function addProjectTypeProject(Project $project): self;
    public function removeProjectTypeProject(Project $project): self;
}
