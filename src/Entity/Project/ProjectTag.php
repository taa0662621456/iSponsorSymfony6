<?php

namespace App\Entity\Project;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class ProjectTag extends RootEntity implements ObjectInterface, \JsonSerializable
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'project')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'projectTag')]
    private Collection $projectTagProject;

    public function __construct()
    {
        parent::__construct();
        $this->projectTagProject = new ArrayCollection();
    }

    public function jsonSerialize(): string
    {
        // This entity implements ObjectInterface, JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
        return $this->firstTitle;
    }

    public function __toString(): string
    {
        return $this->firstTitle;
    }
}
