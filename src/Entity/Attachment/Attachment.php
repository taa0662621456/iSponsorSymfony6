<?php

namespace App\Entity\Attachment;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Repository\Attachment\AttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Table(name: 'attachments')]
#[ORM\Index(columns: ['slug'], name: 'attachments_idx')]
#[ORM\Entity(repositoryClass: AttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Attachment
{
    use BaseTrait;
    use AttachmentTrait;

    #[ORM\Column(name: 'object', type: 'text', nullable: false)]
    private string $object;
    #[ORM\Column(name: 'attachments', type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'attachments.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'attachments.en.gb.too.short')]
    private string $attachments;
    public function getObject(): string
    {
        return $this->object;
    }
    public function setObject(string $object): void
    {
        $this->object = $object;
    }
}
