<?php


namespace App\Entity\Project;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="project_uk_ua", indexes={
 * @ORM\Index(name="project_uk_ua_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
