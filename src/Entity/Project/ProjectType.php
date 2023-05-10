<?php

namespace App\Entity\Project;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectTypeInterface;
use App\Repository\Type\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_type')]
#[ORM\Index(columns: ['slug'], name: 'project_type_idx')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
final class ProjectType extends ObjectSuperEntity implements ObjectInterface, ProjectTypeInterface
{
    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $projectTypeProject;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
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
