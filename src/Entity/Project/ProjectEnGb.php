<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;

use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Table(name: 'projects_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'project_en_gb_idx')]
#[ORM\Entity(repositoryClass: \App\Repository\Project\ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
