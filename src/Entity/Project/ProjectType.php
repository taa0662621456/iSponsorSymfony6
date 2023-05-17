<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectTypeInterface;

#[ORM\Entity]
class ProjectType extends ObjectSuperEntity implements ObjectInterface, ProjectTypeInterface
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
}
