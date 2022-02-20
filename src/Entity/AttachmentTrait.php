<?php


	namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;



    trait AttachmentTrait
	{
        /**
			 */
		#[ORM\Column(name: 'file_name', type: 'string', nullable: false, options: ['default' => 'noimage'])]
		#[Assert\NotBlank(message: "Please, upload the project's pictures as a jpeg/jpg file.")]
		#[Assert\File(mimeTypes: ['image/jpeg', 'image/jpg'], mimeTypesMessage: 'Please, upload the jpeg/jpg files only')]
		private string $fileName = 'no image';


		#[ORM\Column(name: 'file_title', type: 'string', nullable: false, options: ['default' => 'file_title'])]
		private string $fileTitle = 'file_title';


		#[ORM\Column(name: 'file_description', type: 'string', nullable: false, options: ['default' => 'file_description'])]
		private string $fileDescription = 'file_description';


		#[ORM\Column(name: 'file_meta', type: 'string', nullable: false, options: ['default' => 'file_meta'])]
		private string $fileMeta = 'file_meta';


		#[ORM\Column(name: 'file_class', type: 'string', nullable: false, options: ['default' => 'file_class'])]
		private string $fileClass = 'file_class';


		#[Assert\NotBlank(message: 'Please, upload a file.')]
		#[ORM\Column(name: 'file_mime_type', type: 'string', nullable: false, options: ['default' => 'file_mime_type'])]
		private string $fileMimeType = '';


		#[ORM\Column(name: 'file_layout_position', type: 'string', nullable: true, options: ['default' => 'file_layout_position'])]
		private string $fileLayoutPosition = 'file_layout_position';


		#[ORM\Column(name: 'file_path', type: 'string', nullable: false, options: ['default' => ''])]
		private string $filePath = '';


		#[ORM\Column(name: 'file_path_thumb', type: 'string', nullable: false, options: ['default' => ''])]
		private string $filePathThumb = '';

		/**
		 * @var boolean|false
		 */
		#[ORM\Column(name: 'file_is_downloadable', type: 'boolean', nullable: false)]
		private bool $fileIsDownloadable = false;

		/**
		 * @var boolean|false
		 */
		#[ORM\Column(name: 'file_is_for_sale', type: 'boolean', nullable: false)]
		private bool $fileIsForSale = false;


		#[ORM\Column(name: 'file_params', type: 'string', nullable: false, options: ['default' => 'file_params'])]
		private string $fileParams = 'file_params';


		#[ORM\Column(name: 'file_lang', type: 'string', nullable: false, options: ['default' => 'file_lang'])]
		private string $fileLang = 'file_lang';

		/**
		 * @var boolean|false
		 */
		#[ORM\Column(name: 'file_shared', type: 'boolean', nullable: false)]
		private bool $fileShared = false;

		public function getFileName(): string
		{
			return $this->fileName;
		}

		public function setFileName(string $fileName): void
		{
			$this->fileName = $fileName;
		}

		public function getFileTitle(): string
		{
			return $this->fileTitle;
		}

		public function setFileTitle(string $fileTitle): void
		{
			$this->fileTitle = $fileTitle;
		}

		public function getFileDescription(): string
		{
			return $this->fileDescription;
		}

		public function setFileDescription(string $fileDescription): void
		{
			$this->fileDescription = $fileDescription;
		}

		public function getFileMeta(): string
		{
			return $this->fileMeta;
		}

		public function setFileMeta(string $fileMeta): void
		{
			$this->fileMeta = $fileMeta;
		}

		public function getFileClass(): string
		{
			return $this->fileClass;
		}

		public function setFileClass(string $fileClass): void
		{
			$this->fileClass = $fileClass;
		}

		public function getFileMimeType(): string
		{
			return $this->fileMimeType;
		}

		public function setFileMimeType(string $fileMimeType): void
		{
			$this->fileMimeType = $fileMimeType;
		}

		public function getFileLayoutPosition(): string
		{
			return $this->fileLayoutPosition;
		}

		public function setFileLayoutPosition(string $fileLayoutPosition): void
		{
			$this->fileLayoutPosition = $fileLayoutPosition;
		}

		public function getFilePath(): string
		{
			return $this->filePath;
		}

		public function setFilePath(string $filePath): void
		{
			$this->filePath = $filePath;
		}

		public function getFilePathThumb(): string
		{
			return $this->filePathThumb;
		}

		public function setFilePathThumb(string $filePathThumb): void
		{
			$this->filePathThumb = $filePathThumb;
		}

		public function getFileIsDownloadable(): bool
        {
			return $this->fileIsDownloadable;
		}

		public function setFileIsDownloadable(bool $fileIsDownloadable = false): void
		{
			$this->fileIsDownloadable = $fileIsDownloadable;
		}

		public function getFileIsForSale(): bool
        {
			return $this->fileIsForSale;
		}

		public function setFileIsForSale(bool $fileIsForSale = false): void
		{
			$this->fileIsForSale = $fileIsForSale;
		}

		public function getFileParams(): string
		{
			return $this->fileParams;
		}

		public function setFileParams(string $fileParams): void
		{
			$this->fileParams = $fileParams;
		}

		public function getFileLang(): string
		{
			return $this->fileLang;
		}

		public function setFileLang(string $fileLang): void
		{
			$this->fileLang = $fileLang;
		}

		public function getFileShared(): bool
        {
            return $this->fileShared;
        }

        public function setFileShared(bool $fileShared = false): void
        {
            $this->fileShared = $fileShared;
        }
    }
