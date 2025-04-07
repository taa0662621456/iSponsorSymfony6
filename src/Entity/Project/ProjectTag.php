<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class ProjectTag extends RootEntity implements ObjectInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'projectTag')]
    private Collection $projectTag;

    public function __construct()
    {
        parent::__construct();
        $this->projectTag = new ArrayCollection();
    }

}
