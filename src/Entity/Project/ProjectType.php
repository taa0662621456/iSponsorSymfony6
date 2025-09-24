<?php

namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\Project\ProjectTypeInterface;
use App\Repository\Type\ProductTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'project_type')]
#[ORM\Index(columns: ['slug'], name: 'project_type_idx')]
#[ORM\Entity(repositoryClass: ProductTypeRepository::class)]
#
#[ApiResource()]
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
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->projectTypeProject = new ArrayCollection();


        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
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