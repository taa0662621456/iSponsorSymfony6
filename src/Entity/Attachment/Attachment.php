<?php

namespace App\Entity\Attachment;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Attachment\AttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'attachment')]
#[ORM\Index(columns: ['slug'], name: 'attachment_idx')]
#[ORM\Entity(repositoryClass: AttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Attachment
{
    use BaseTrait;
    use ObjectTrait;
    use AttachmentTrait;
}
