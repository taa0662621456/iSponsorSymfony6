<?php
namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Repository\Project\ProjectTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_type')]
#[ORM\Index(columns: ['slug'], name: 'project_type_idx')]
#[ORM\Entity(repositoryClass: ProjectTypeRepository::class)]
class ProjectType
{
    use BaseTrait;

    #[ORM\OneToOne(inversedBy: 'projectType', targetEntity: Project::class)]
    private Project $projectType;

    /**
     * @return Project
     */
    public function getProjectType(): Project
    {
        return $this->projectType;
    }

    /**
     * @param $projectType
     */
    public function setProjectType($projectType): void
    {
        $this->projectType = $projectType;
    }


}
