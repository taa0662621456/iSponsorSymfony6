<?php


namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\AttachmentTrait;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Project\ProjectAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_attachment')]
#[ORM\Index(columns: ['slug'], name: 'project_attachment_idx')]
#[ORM\Entity(repositoryClass: ProjectAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class ProjectAttachment
{
	use ObjectBaseTrait;
    use ObjectTitleTrait;
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
