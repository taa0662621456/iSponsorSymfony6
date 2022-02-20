<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Project\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_ru_ru')]
#[ORM\Index(columns: ['slug'], name: 'project_ru_ru_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
