<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projects_attachments", indexes={
 * @ORM\Index(name="project_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectsAttachmentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectsAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Project\Projects",
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
	 * @param Projects $projectAttachments
	 */
	public function setProjectAttachments(Projects $projectAttachments): void
	{
		$this->projectAttachments = $projectAttachments;
	}

}
