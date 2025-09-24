<?php


namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Project\ProjectAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'project_attachment')]
#[ORM\Index(columns: ['slug'], name: 'project_attachment_idx')]
#[ORM\Entity(repositoryClass: ProjectAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]


class ProjectAttachment
{
	use BaseTrait;
    use ObjectTrait;
    use AttachmentTrait;

	#[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectAttachment')]
	#[ORM\JoinColumn(onDelete: 'CASCADE')]
	private Project $projectAttachmentProject;

    # ManyToOne
	public function getProjectAttachmentProject(): Project
    {
		return $this->projectAttachmentProject;
	}
    public function setProjectAttachmentProject(Project $attachment): void
    {
            $this->projectAttachmentProject = $attachment;
    }

}
