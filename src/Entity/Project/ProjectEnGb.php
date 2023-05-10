<?php

namespace App\Entity\Project;

use App\Entity\ObjectSuperEntity;
use App\Entity\ProjectLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Interface\Project\ProjectTitleInterface;
use App\Repository\Project\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'project_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ProjectEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface, ProjectTitleInterface
{
    use ProjectLanguageTrait;
}
