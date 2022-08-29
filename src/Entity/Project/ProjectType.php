<?php
namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\ProjectTypeInterface;
use App\Repository\Project\ProjectTypeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


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
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->projectType = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
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
