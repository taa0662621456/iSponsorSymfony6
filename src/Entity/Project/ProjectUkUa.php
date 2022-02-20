<?php


namespace App\Entity\Project;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Project\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_uk_ua')]
#[ORM\Index(columns: ['slug'], name: 'project_uk_ua_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
