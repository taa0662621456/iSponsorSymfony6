<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

trait AttachmentDTOTrait
{
    #[Vich\UploadableField(mapping: 'attachment', fileNameProperty: 'fileName', size: 'fileSize')]
    #[Assert\NotBlank(message: 'Please, upload the project pictures as a jpeg/jpg or PDF file.')]
    #[Assert\File(
        maxSize: '2M',

        mimeTypes: ['application/pdf', 'application/x-pdf'],
        notReadableMessage: 'notReadableMessage',
        maxSizeMessage: 'The file could not be loaded. File size too large',
        mimeTypesMessage: 'Please, upload the jpeg/jpg or PDF file only',
        disallowEmptyMessage: 'File is empty')]

    #[Assert\Image(
        maxSize: '2M',

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

    private ?string $fileName = 'noimage.jpg';

    private string $filePath = '/';

    private ?int $fileSize = 0;

    #[Vich\UploadableField(mapping: 'fileThumbName', fileNameProperty: 'fileThumbName')]
    private $fileThumbFile;

    private string $fileThumbName = '';

    private string $fileThumbPath = '';

    private string $fileClass = 'file_class';

    #[Assert\NotBlank(message: 'Please, upload a file.')]

    private string $fileMimeType = '';

    private ?string $fileLayoutPosition = 'homepage';

    private bool $fileIsDownloadable = false;

    private bool $fileIsForSale = false;

    private string $fileParam = 'file_params';

    private string $fileLang = 'file_lang';

    private bool $fileShared = false;

    public function __construct(?File $file, ?string $fileName)
    {
        $this->file = $file;
        $this->fileName = $fileName;
    }

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

    public function setFile(?File $file = null): void
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
