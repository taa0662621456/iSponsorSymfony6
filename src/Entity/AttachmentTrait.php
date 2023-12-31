<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

trait AttachmentTrait
{
    #[Vich\UploadableField(mapping: 'attachment', fileNameProperty: 'fileName', size: 'fileSize')]
    #[Assert\NotBlank(message: 'Please, upload the project pictures as a jpeg/jpg or PDF file.')]
    #[Assert\File(
        maxSize: '2M',
        binaryFormat: false,
        mimeTypes: ['application/pdf', 'application/x-pdf'],
        notReadableMessage: 'notReadableMessage',
        maxSizeMessage: 'The file could not be loaded. File size too large',
        mimeTypesMessage: 'Please, upload the jpeg/jpg or PDF file only',
        disallowEmptyMessage: 'File is empty',
        uploadFormSizeErrorMessage: 'The file could not be loaded. File size too large',
        uploadNoFileErrorMessage: 'Fine does not exist',
        uploadErrorMessage: 'The file could not be uploaded for an unknown reason'
    )]
    #[Assert\Image(
        maxSize: '2M',
        binaryFormat: '',
        mimeTypes: ['image/jpeg', 'image/jpg'],
        minWidth: '200',
        maxWidth: '500',
        maxHeight: '1000',
        minHeight: '200',
        minPixels: '100',
        maxPixels: '200',
        detectCorrupted: true,
        notReadableMessage: 'notReadableMessage',
        maxSizeMessage: 'maxSizeMessage',
        mimeTypesMessage: 'Please, upload the jpeg/jpg or PDF file only',
        sizeNotDetectedMessage: '',
        maxWidthMessage: 'maxWidthMessage',
        maxHeightMessage: 'maxHeightMessage',
        minHeightMessage: 'minHeightMessage',
        minPixelsMessage: 'minPixelsMessage',
        maxPixelsMessage: 'maxPixelsMessage',
        corruptedMessage: 'corruptedMessage'
    )]
    private ?File $file = null;

    #[ORM\Column(name: 'file_name', type: 'string', length: 200, nullable: true, options: ['default' => 'noimage.jpg'])]
    private ?string $fileName = 'noimage.jpg';

    #[ORM\Column(name: 'file_path', type: 'string', nullable: false, options: ['default' => ''])]
    private string $filePath = '/';

    #[ORM\Column(name: 'file_size', type: 'integer', nullable: true)]
    private ?int $fileSize = 0;

    #[Vich\UploadableField(mapping: 'fileThumbName', fileNameProperty: 'fileThumbName')]
    private $fileThumbFile;

    #[ORM\Column(name: 'file_thumb_name', type: 'string', length: 100, nullable: true, options: ['default' => ''])]
    private string $fileThumbName;

    #[ORM\Column(name: 'file_thumb_path', type: 'string', nullable: false, options: ['default' => ''])]
    private string $fileThumbPath = '';

    #[ORM\Column(name: 'file_class', type: 'string', nullable: false, options: ['default' => 'file_class'])]
    private string $fileClass = 'file_class';

    #[Assert\NotBlank(message: 'Please, upload a file.')]
    #[ORM\Column(name: 'file_mime_type', type: 'string', nullable: true, options: ['default' => 'file_mime_type'])]
    private ?string $fileMimeType;

    #[ORM\Column(name: 'file_layout_position', nullable: true)]
    private ?string $fileLayoutPosition = 'homepage';

    #[ORM\Column(name: 'file_is_downloadable', type: 'boolean', nullable: true)]
    private bool $fileIsDownloadable = false;

    #[ORM\Column(name: 'file_is_for_sale', type: 'boolean', nullable: true)]
    private bool $fileIsForSale = false;

    #[ORM\Column(name: 'file_params', type: 'string', nullable: false, options: ['default' => 'file_params'])]
    private string $fileParam = 'file_params';

    #[ORM\Column(name: 'file_lang', type: 'string', nullable: false, options: ['default' => 'file_lang'])]
    private string $fileLang = 'file_lang';

    #[ORM\Column(name: 'file_shared', type: 'boolean', nullable: true)]
    private bool $fileShared = false;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
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

    public function setFileMimeType(?string $fileMimeType): void
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

    public function getFileThumbFile()
    {
        return $this->fileThumbFile;
    }

    public function setFileThumbFile($fileThumbFile): void
    {
        $this->fileThumbFile = $fileThumbFile;
    }

    public function getFileThumbName(): string
    {
        return $this->fileThumbName;
    }

    public function setFileThumbName(string $fileThumbName): void
    {
        $this->fileThumbName = $fileThumbName;
    }

    public function getFileThumbPath(): string
    {
        return $this->fileThumbPath;
    }

    public function setFileThumbPath(string $fileThumbPath): void
    {
        $this->fileThumbPath = $fileThumbPath;
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

    public function getFileParam(): string
    {
        return $this->fileParam;
    }

    public function setFileParam(string $fileParam): void
    {
        $this->fileParam = $fileParam;
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

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(File $file = null): void
    {
        $this->file = $file;
    }

    public function setFileSize(int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }
}
