<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


trait ObjectVichUploadField
{

    #[ORM\Column(name: 'thumbnail', type: 'string', length: 100, nullable: true)]
    private ?string $thumbnail = null;

    #[Vich\UploadableField(mapping: 'vendorMedia', fileNameProperty: 'thumbnail')]
    private $thumbnailFile;


    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }
    public function setThumbnailFile($thumbnailFile): void
    {
        $this->thumbnailFile = $thumbnailFile;
    }


}
