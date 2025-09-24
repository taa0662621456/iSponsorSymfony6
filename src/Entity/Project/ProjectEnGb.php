<?php

namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;

use App\Entity\ObjectTrait;
use App\Entity\ProjectLanguageTrait;
use App\Repository\Project\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'project_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'project_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]

#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
    "projectTitle" => "partial",
    "projectSDesc" => "partial",
    "projectDesc" => "partial",
])]
class ProjectEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
