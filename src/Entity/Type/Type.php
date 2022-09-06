<?php

namespace App\Entity\Type;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Project\Project;
use App\Interface\TypeInterface;
use App\Repository\Type\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'type')]
#[ORM\Index(columns: ['slug'], name: 'type_idx')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type implements TypeInterface
{
    use BaseTrait;
    use ObjectTrait;

    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $typeProject;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $t = new \DateTime();
        $this->slug = (string)Uuid::v4();
        $this->typeProject = new ArrayCollection();


        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    public function getTypeProject(): Collection
    {
        return $this->typeProject;
    }

    public function addTypeProject(Project $project): self
    {
        if (!$this->typeProject->contains($project)){
            $this->typeProject[] = $project;
        }
        return $this;
    }
    public function removeTypeProject(Project $project): self
    {
        if ($this->typeProject->contains($project)){
            $this->typeProject->removeElement($project);
        }
        return $this;
    }



}
