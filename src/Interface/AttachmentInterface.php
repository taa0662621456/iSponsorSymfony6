<?php

namespace App\Interface;

interface AttachmentInterface
{
    public function getFileName(): string;

    public function setFileName(string $fileName): void;

    public function getFileTitle(): string;

    public function setFileTitle(string $fileTitle): void;

    public function getFileDescription(): string;

    public function setFileDescription(string $fileDescription): void;

    public function getFileMeta(): string;

    public function setFileMeta(string $fileMeta): void;

    public function getFileClass(): string;

    public function setFileClass(string $fileClass): void;

    public function getFileMimeType(): string;

    public function setFileMimeType(string $fileMimeType): void;

    public function getFileLayoutPosition(): string;

    public function setFileLayoutPosition(string $fileLayoutPosition): void;

    public function getFilePath(): string;

    public function setFilePath(string $filePath): void;

    public function getFilePathThumb(): string;

    public function setFilePathThumb(string $filePathThumb): void;

    public function getFileIsDownloadable(): bool;

    public function setFileIsDownloadable(bool $fileIsDownloadable = false): void;

    public function getFileIsForSale(): bool;

    public function setFileIsForSale(bool $fileIsForSale = false): void;

    public function getFileParams(): string;

    public function setFileParams(string $fileParams): void;

    public function getFileLang(): string;

    public function setFileLang(string $fileLang): void;

    public function getFileShared(): bool;

    public function setFileShared(bool $fileShared = false): void;

    public function getObject(): string;

    public function setObject(string $object): void;

}
