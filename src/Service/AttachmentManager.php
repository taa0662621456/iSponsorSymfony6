<?php
declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentManager
{
    /**
     * @var ContainerInterface 
     */
    private $container;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * @param UploadedFile $file
     * @param $entity
     * @param $attachment
     * @return array
     */
    public function uploadAttachment(UploadedFile $file, $entity, $attachment)
    {
        $filename = md5(uniqid()) .'.'. $file->guessExtension();

        $file->move(
            $this->getUploadsDirectory(),
            $filename
        );
        $attachment->setFile($filename);
        $attachment->setFilePath('/uploads/' . $file);
        $attachment->setPost($entity);

        $entity->setAttachments($attachment);

        $this->entityManager->persist($attachment);
        $this->entityManager->flush();


        return [
            'filename' => $filename,
            'path' => '/uploads/' . $filename
        ];
    }

    public function removeAttachment(?string $filename)
    {
        if (!empty($filename)){
            $filesystem = new Filesystem();
            $filesystem->remove($this->getUploadsDirectory(). $filename);
        }
    }
    public function getUploadsDirectory()
    {
        return $this->container->getParameter('uploads');

    }

}