<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\ProjectLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Interface\Project\ProjectTitleInterface;

#[ORM\Entity]
final class ProjectEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface, ProjectTitleInterface
{
    use ProjectLanguageTrait;
}
