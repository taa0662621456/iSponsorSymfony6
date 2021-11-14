<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projects_attachments", indexes={
 * @ORM\Index(name="project_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectAttachmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectAttachment
{
	use BaseTrait;
	use AttachmentTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Project\Project",
	 *     inversedBy="projectAttachments")
	 * @ORM\JoinColumn(name="projectAttachments_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $projectAttachments;

    /**
     * @return mixed
     */
	public function getProjectAttachments()
	{
		return $this->projectAttachments;
	}

	/**
	 * @param Project $projectAttachments
	 */
	public function setProjectAttachments(Project $projectAttachments): void
	{
		$this->projectAttachments = $projectAttachments;
	}

}
