<?php

namespace App\Entity\Attachment;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Attachment\AttachmentRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'attachment')]
#[ORM\Index(columns: ['slug'], name: 'attachment_idx')]
#[ORM\Entity(repositoryClass: AttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Attachment
{
    use BaseTrait;
    use ObjectTrait;
    use AttachmentTrait;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
}
