<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CategoryUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid('', true)).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
