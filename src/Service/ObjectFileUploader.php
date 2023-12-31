<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ObjectFileUploader
{
    public function __construct(
        private $targetDirectory,
        private readonly SluggerInterface $slugger,
        private readonly ObjectInitializer $objectInitializer
    ) {
    }

    /**
     * TODO: возможно $targetDirectory сделать массивом параметров (переделать в service.yaml)
     * TODO: 1. Понять, какой объект аплодит файл;
     * 2. Подставить файлу имя с префиксом, соответствующим объекту
     * 3. Подставить путь, соответствующий объекту.
     */
    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // TODO: ... handle exception if something happens during file upload; показать сообщение обб ошибке
            return '... handle exception if something happens during file upload; показать сообщение обб ошибке';
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
