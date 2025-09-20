<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\ProjectTypeInterface;
use App\Repository\Type\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'project_type')]
#[ORM\Index(columns: ['slug'], name: 'project_type_idx')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
class ProjectType implements ProjectTypeInterface
{
    use BaseTrait;
    use ObjectTrait;

    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $projectTypeProject;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $t = new \DateTime();
        $this->slug = (string)Uuid::v4();
        $this->projectTypeProject = new ArrayCollection();


        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
    #
    public function getProjectTypeProject(): Collection
    {
        return $this->projectTypeProject;
    }
    public function addProjectTypeProject(Project $project): self
    {
        if (!$this->projectTypeProject->contains($project)){
            $this->projectTypeProject[] = $project;
        }
        return $this;
    }
    public function removeProjectTypeProject(Project $project): self
    {
        if ($this->projectTypeProject->contains($project)){
            $this->projectTypeProject->removeElement($project);
        }
        return $this;
    }



}
