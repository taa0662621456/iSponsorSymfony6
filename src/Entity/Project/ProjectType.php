<?php
namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\ProjectTypeInterface;
use App\Repository\Project\ProjectTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;


#[ORM\Table(name: 'project_type')]
#[ORM\Index(columns: ['slug'], name: 'project_type_idx')]
#[ORM\Entity(repositoryClass: ProjectTypeRepository::class)]
class ProjectType implements ProjectTypeInterface
{
    use BaseTrait;
    use ObjectTrait;

    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $projectType;

    public function __construct()
    {
        $this->projectType = new ArrayCollection();
    }
    # OneToMany
    public function getProjectType(): Collection
    {
        return $this->projectType;
    }
    public function addProjectType(Project $project): self
    {
        if (!$this->projectType->contains($project)){
            $this->projectType[] = $project;
        }
        return $this;
    }
    public function removeProjectType(Project $project): self
    {
        if ($this->projectType->contains($project)){
            $this->projectType->removeElement($project);
        }
        return $this;
    }
}
