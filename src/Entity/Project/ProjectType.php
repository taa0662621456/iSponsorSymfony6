<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Project\ProjectTypeInterface;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
final class ProjectType extends ObjectSuperEntity implements ObjectInterface, ProjectTypeInterface
{
    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $projectTypeProject;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->projectTypeProject = new ArrayCollection();
    }

    public function getProjectTypeProject(): Collection
    {
        return $this->projectTypeProject;
    }

    public function addProjectTypeProject(Project $project): self
    {
        if (!$this->projectTypeProject->contains($project)) {
            $this->projectTypeProject[] = $project;
        }

        return $this;
    }

    public function removeProjectTypeProject(Project $project): self
    {
        if ($this->projectTypeProject->contains($project)) {
            $this->projectTypeProject->removeElement($project);
        }

        return $this;
    }
}
