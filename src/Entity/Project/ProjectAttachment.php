<?php


namespace App\Entity\Project;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Repository\Project\ProjectAttachmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_attachment')]
#[ORM\Index(columns: ['slug'], name: 'project_attachment_idx')]
#[ORM\Entity(repositoryClass: ProjectAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectAttachment
{
	use BaseTrait;
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
