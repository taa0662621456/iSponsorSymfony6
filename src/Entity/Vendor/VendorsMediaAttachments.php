<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\EntitySystemTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_medias", indexes={
 * @ORM\Index(name="vendor_media_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsMediaAttachments
{
	use EntitySystemTrait;

	/**
	 * //пока только картинки, а вообще поле для разных типов (сохраняет имена файлов)
	 *
	 * @var string
	 *
	 * @ORM\Column(name="file", type="string", nullable=false, options={"default"="noimage"})
	 * @Assert\NotBlank(message="Please, upload the project's pictures as a jpeg/jpg file.")
	 * @Assert\File(mimeTypes={"image/jpeg", "image/jpg"}, mimeTypesMessage="Please, upload the jpeg/jpg files only")
	 */
	protected $file = 'no image';

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
	 * @ORM\Column(name="file_url", type="string", nullable=false, options={"default"=""})
	 */
	private $fileUrl = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="file_url_thumb", type="string", nullable=false, options={"default"=""})
	 */
	private $fileUrlThumb = '';

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
	 * @ORM\Column(name="is_shared", type="boolean", nullable=false)
	 */
	private $isShared = false;

	/**
	 * @var boolean|true
	 *
	 * @ORM\Column(name="published", type="boolean", nullable=false, options={"default"="1"})
	 */
	private $published = true;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorsMediasAttachments")
	 * @ORM\JoinColumn(name="vendorMediaAttachments_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
	 */
	private $vendorMediaAttachments;


	/**
	 * @return string
	 */
	public function getFile(): string
	{
		return $this->file;
	}

	/**
	 * @param string $file
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
	 */
	public function setFileType(string $fileType): self
	{
		$this->fileType = $fileType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileUrl(): string
	{
		return $this->fileUrl;
	}

	/**
	 * @param string $fileUrl
	 *
	 * @return VendorsMediaAttachments
	 */
	public function setFileUrl(string $fileUrl): self
	{
		$this->fileUrl = $fileUrl;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFileUrlThumb(): string
	{
		return $this->fileUrlThumb;
	}

	/**
	 * @param string $fileUrlThumb
	 *
	 * @return VendorsMediaAttachments
	 */
	public function setFileUrlThumb(string $fileUrlThumb): self
	{
		$this->fileUrlThumb = $fileUrlThumb;
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
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
	 * @return VendorsMediaAttachments
	 */
	public function setFileLang(string $fileLang): self
	{
		$this->fileLang = $fileLang;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isShared(): bool
	{
		return $this->isShared;
	}

	/**
	 * @param bool $isShared
	 *
	 * @return VendorsMediaAttachments
	 */
	public function setIsShared(bool $isShared): self
	{
		$this->isShared = $isShared;
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
	 * @return VendorsMediaAttachments
	 */
	public function setPublished(bool $published): self
	{
		$this->published = $published;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getVendorMediaAttachments()
	{
		return $this->vendorMediaAttachments;
	}

	/**
	 * @param mixed $vendorMediaAttachments
	 */
	public function setVendorMediaAttachments($vendorMediaAttachments): void
	{
		$this->vendorMediaAttachments = $vendorMediaAttachments;
	}


}
