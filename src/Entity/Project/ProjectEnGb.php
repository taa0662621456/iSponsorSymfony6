<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\ProjectLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\EntityInterface\Project\ProjectTitleInterface;

#[ORM\Entity]
class ProjectEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface, ProjectTitleInterface
{
    use ProjectLanguageTrait;
}
