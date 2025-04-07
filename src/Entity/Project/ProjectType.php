<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectTypeInterface;
use Exception;

#[ORM\Entity]
class ProjectType extends RootEntity implements ObjectInterface, ProjectTypeInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: 'projectType', targetEntity: Project::class)]
    private Collection $projectTypeProject;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->projectTypeProject = new ArrayCollection();
    }
}
