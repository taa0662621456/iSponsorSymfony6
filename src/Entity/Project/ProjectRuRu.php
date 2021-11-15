<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="project_ru_ru", indexes={
 * @ORM\Index(name="project_ru_ru_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
