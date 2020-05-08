<?php
	declare(strict_types=1);

	namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

	trait AttachmentsTrait
	{

        /**
         * @var string
         *
         * @ORM\Column(name="file_name", type="string", nullable=false, options={"default"="noimage"})
         * @Assert\NotBlank(message="Please, upload the project's pictures as a jpeg/jpg file.")
         * @Assert\File(mimeTypes={"image/jpeg", "image/jpg"},
         *     mimeTypesMessage="Please, upload the jpeg/jpg files only")
         */
		private $fileName = 'no image';

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
		 * @ORM\Column(name="file_layout_position", type="string", nullable=true,
		 *                                          options={"default"="file_layout_position"})
		 */
		private $fileLayoutPosition = 'file_layout_position';

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
		 * @return string
		 */
		public function getFileName(): string
		{
			return $this->fileName;
		}

		/**
		 * @param string $fileName
		 */
		public function setFileName(string $fileName): void
		{
			$this->fileName = $fileName;
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
		 */
		public function setFileTitle(string $fileTitle): void
		{
			$this->fileTitle = $fileTitle;
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
		 */
		public function setFileDescription(string $fileDescription): void
		{
			$this->fileDescription = $fileDescription;
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
		 */
		public function setFileMeta(string $fileMeta): void
		{
			$this->fileMeta = $fileMeta;
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
		 */
		public function setFileClass(string $fileClass): void
		{
			$this->fileClass = $fileClass;
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
		 */
		public function setFileMimeType(string $fileMimeType): void
		{
			$this->fileMimeType = $fileMimeType;
		}

		/**
		 * @return string
		 */
		public function getFileLayoutPosition(): string
		{
			return $this->fileLayoutPosition;
		}

		/**
		 * @param string $fileLayoutPosition
		 */
		public function setFileLayoutPosition(string $fileLayoutPosition): void
		{
			$this->fileLayoutPosition = $fileLayoutPosition;
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
		 */
		public function setFilePath(string $filePath): void
		{
			$this->filePath = $filePath;
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
		 */
		public function setFilePathThumb(string $filePathThumb): void
		{
			$this->filePathThumb = $filePathThumb;
		}

		/**
		 * @return bool|false
		 */
		public function getFileIsDownloadable()
		{
			return $this->fileIsDownloadable;
		}

		/**
		 * @param bool|false $fileIsDownloadable
		 */
		public function setFileIsDownloadable($fileIsDownloadable): void
		{
			$this->fileIsDownloadable = $fileIsDownloadable;
		}

		/**
		 * @return bool|false
		 */
		public function getFileIsForSale()
		{
			return $this->fileIsForSale;
		}

		/**
		 * @param bool|false $fileIsForSale
		 */
		public function setFileIsForSale($fileIsForSale): void
		{
			$this->fileIsForSale = $fileIsForSale;
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
		 */
		public function setFileParams(string $fileParams): void
		{
			$this->fileParams = $fileParams;
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
		 */
		public function setFileLang(string $fileLang): void
		{
			$this->fileLang = $fileLang;
		}

		/**
		 * @return bool|false
		 */
		public function getFileShared()
		{
            return $this->fileShared;
        }

        /**
         * @param bool|false $fileShared
         */
        public function setFileShared($fileShared): void
        {
            $this->fileShared = $fileShared;
        }
    }
