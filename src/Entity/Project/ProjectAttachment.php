<?php


namespace App\Entity\Project;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Repository\Project\ProjectAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'projects_attachments')]
#[ORM\Index(columns: ['slug'], name: 'project_attachment_idx')]
#[ORM\Entity(repositoryClass: ProjectAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectAttachment
{
	use BaseTrait;
	use AttachmentTrait;
/*	#[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectAttachments')]*/
	#[ORM\ManyToOne(inversedBy: 'projectAttachments')]
	#[ORM\JoinColumn(name: 'projectAttachments_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private ?Project $projectAttachments = null;

    /**
     * @return Project
     */
	public function getProjectAttachments()
	{
		return $this->projectAttachments;
	}
	public function setProjectAttachments(Project $projectAttachments): void
	{
		$this->projectAttachments = $projectAttachments;
	}
}
