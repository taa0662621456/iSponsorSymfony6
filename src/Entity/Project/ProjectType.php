<?php

namespace App\Entity\Project;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectTypeInterface;

#[ORM\Entity]
class ProjectType extends RootEntity implements ObjectInterface, ProjectTypeInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'project')]
    private ObjectProperty $objectProperty;


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
