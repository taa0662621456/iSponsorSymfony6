<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\BaseTrait;

use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Table(name="projects_en_gb", indexes={
 * @ORM\Index(name="project_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}
