<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;

use App\Entity\ObjectTrait;
use App\Repository\Project\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Table(name: 'project_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'project_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
