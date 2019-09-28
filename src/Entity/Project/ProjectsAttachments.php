<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\EntitySystemTrait;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="projects_attachments", indexes={
 * @ORM\Index(name="project_attachment_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectsAttachments
{
	use EntitySystemTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file", type="string", nullable=false, options={"default"="noimage"})
	 * @Assert\NotBlank(message="Please, upload the project's pictures as a jpeg/jpg file.")
	 * @Assert\File(mimeTypes={"image/jpeg", "image/jpg"}, mimeTypesMessage="Please, upload the jpeg/jpg files only")
	 */
	private $file = 'no image';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_title", type="string", nullable=false, options={"default"="file_title"})
	 */
	private $fileTitle = 'file_title';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_description", type="string", nullable=false, options={"default"="file_description"})
	 */
	private $fileDescription = 'file_description';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_meta", type="string", nullable=false, options={"default"="file_meta"})
	 */
	private $fileMeta = 'file_meta';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_class", type="string", nullable=false, options={"default"="file_class"})
	 */
	private $fileClass = 'file_class';

	/**
	 * @var string
	 * @Assert\NotBlank(message="Please, upload a file.")
	 * @ORM\Column(name="file_mime_type", type="string", nullable=false, options={"default"="file_mime_type"})
	 */
	private $fileMimeType = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_type", type="string", nullable=false, options={"default"=""})
	 */
	private $fileType = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_path", type="string", nullable=false, options={"default"=""})
	 */
	private $filePath = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_path_thumb", type="string", nullable=false, options={"default"=""})
	 */
	private $filePathThumb = '';

	/**
	 * @var boolean|true
	 *
	 * @ORM\Column(name="file_is_product_image", type="boolean", nullable=false)
	 */
	private $fileIsProductImage = true;

	/**
	 * @var boolean|false
	 *
	 * @ORM\Column(name="file_is_downloadable", type="boolean", nullable=false)
	 */
	private $fileIsDownloadable = false;

	/**
	 * @var boolean|false
	 *
	 * @ORM\Column(name="file_is_for_sale", type="boolean", nullable=false)
	 */
	private $fileIsForSale = false;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_params", type="string", nullable=false, options={"default"="file_params"})
	 */
	private $fileParams = 'file_params';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_lang", type="string", nullable=false, options={"default"="file_lang"})
	 */
	private $fileLang = 'file_lang';

	/**
	 * @var boolean|false
	 *
	 * @ORM\Column(name="file_shared", type="boolean", nullable=false)
	 */
	private $fileShared = false;

	/**
	 * @var boolean|true
	 *
	 * @ORM\Column(name="published", type="boolean", nullable=false, options={"default"="1"})
	 */
	private $published = true;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Project\Projects", inversedBy="projectAttachments")
	 * @ORM\JoinColumn(name="projectAttachments_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $projectAttachments;


	/**
	 * @return string
	 */
	public function getFile(): string
	{
		return $this->file;
	}

	/**
	 * @param mixed $file
	 */
	public function setFile(string $file): void
	{
		$this->file = $file;
	}

	/**
	 * @return string
	 */
	public function getFileTitle(): string
	{
		return $this->fileTitle;
	}

	/**
	 * @param string $fileTitle
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileTitle(string $fileTitle): self
	{
		$this->fileTitle = $fileTitle;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileDescription(): string
	{
		return $this->fileDescription;
	}

	/**
	 * @param string $fileDescription
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileDescription(string $fileDescription): self
	{
		$this->fileDescription = $fileDescription;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileMeta(): string
	{
		return $this->fileMeta;
	}

	/**
	 * @param string $fileMeta
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileMeta(string $fileMeta): self
	{
		$this->fileMeta = $fileMeta;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileClass(): string
	{
		return $this->fileClass;
	}

	/**
	 * @param string $fileClass
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileClass(string $fileClass): self
	{
		$this->fileClass = $fileClass;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileMimeType(): string
	{
		return $this->fileMimeType;
	}

	/**
	 * @param string $fileMimeType
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileMimeType(string $fileMimeType): self
	{
		$this->fileMimeType = $fileMimeType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileType(): string
	{
		return $this->fileType;
	}

	/**
	 * @param string $fileType
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileType(string $fileType): self
	{
		$this->fileType = $fileType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFilePath(): string
	{
		return $this->filePath;
	}

	/**
	 * @param string $filePath
	 *
	 * @return ProjectsAttachments
	 */
	public function setFilePath(string $filePath): self
	{
		$this->filePath = $filePath;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFilePathThumb(): string
	{
		return $this->filePathThumb;
	}

	/**
	 * @param string $filePathThumb
	 *
	 * @return ProjectsAttachments
	 */
	public function setFilePathThumb(string $filePathThumb): self
	{
		$this->filePathThumb = $filePathThumb;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getProjectAttachments(): ?Projects
	{
		return $this->projectAttachments;
	}

	/**
	 * @param $projectAttachments
	 *
	 * @return ProjectsAttachments
	 */
	public function setProjectAttachments($projectAttachments): self
	{
		$this->projectAttachments = $projectAttachments;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isFileIsProductImage(): bool
	{
		return $this->fileIsProductImage;
	}

	/**
	 * @param bool $fileIsProductImage
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileIsProductImage(bool $fileIsProductImage): self
	{
		$this->fileIsProductImage = $fileIsProductImage;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function fileIsDownloadable(): bool
	{
		return $this->fileIsDownloadable;
	}

	/**
	 * @param bool $fileIsDownloadable
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileIsDownloadable(bool $fileIsDownloadable): self
	{
		$this->fileIsDownloadable = $fileIsDownloadable;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function fileIsForSale(): bool
	{
		return $this->fileIsForSale;
	}

	/**
	 * @param bool $fileIsForSale
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileIsForSale(bool $fileIsForSale): self
	{
		$this->fileIsForSale = $fileIsForSale;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileParams(): string
	{
		return $this->fileParams;
	}

	/**
	 * @param string $fileParams
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileParams(string $fileParams): self
	{
		$this->fileParams = $fileParams;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileLang(): string
	{
		return $this->fileLang;
	}

	/**
	 * @param string $fileLang
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileLang(string $fileLang): self
	{
		$this->fileLang = $fileLang;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isFileShared(): bool
	{
		return $this->fileShared;
	}

	/**
	 * @param bool $fileShared
	 *
	 * @return ProjectsAttachments
	 */
	public function setFileShared(bool $fileShared): self
	{
		$this->fileShared = $fileShared;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isPublished(): bool
	{
		return $this->published;
	}

	/**
	 * @param bool $published
	 *
	 * @return ProjectsAttachments
	 */
	public function setPublished(bool $published): self
	{
		$this->published = $published;
		return $this;
	}

}
