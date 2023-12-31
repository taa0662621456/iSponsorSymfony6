<?php

namespace App\Entity\Project;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ProjectLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;
use App\EntityInterface\Project\ProjectTitleInterface;

#[ORM\Entity]
class ProjectEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface, ProjectTitleInterface
{
    use ProjectLanguageTrait;
}
