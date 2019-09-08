<?php
declare(strict_types=1);

namespace App\Event;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderEvent
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity): void
    {

        /*/ загрузка работает только для сущностей Product
        if (!$entity instanceof Product) {
        return;
        }
        */

        $file = $entity->getFileName();

        // загружать только новые файлы
        if ($file instanceof UploadedFile) {
        $fileName = $this->uploader->upload($file);
        $entity->setFileName($fileName);
        }
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        /*

        if (!$entity instanceof Product) {
            return;
        }
        */

        if ($fileName = $entity->getFileName()) {
            $entity->setFileName(new File($this->uploader->getTargetDir().'/'.$fileName));
        }
    }
}