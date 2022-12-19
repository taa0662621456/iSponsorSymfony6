<?php


namespace App\Event;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderEvent
{
    public function __construct(private readonly UploadedFile $uploader)
    {
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


        if ($file instanceof UploadedFile) {
        //$fileName = $this->uploader->uploader($file); // TODO: загружать только новые файлы

            $entity->setFirstTitle($fileName);
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

        if ($fileName = $entity->getFirstTitle()) {
//            $entity->setFileName(new File($this->uploader->getTargetDir().'/'.$fileName)); // TODO: загружать: нет метода
        }
    }
}
