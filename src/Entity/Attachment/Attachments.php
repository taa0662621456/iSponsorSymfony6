<?php

namespace App\Entity\Attachment;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="attachments", indexes={
 * @ORM\Index(name="attachments_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Attachment\AttachmentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Attachments
{
    use BaseTrait;
    use AttachmentTrait;

    /**
     * @var string
     * @ORM\Column(name="object", type="text", nullable=false)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="attachments", type="string", nullable=false)
     * @Assert\NotBlank(message="attachments_en_gb.blank_content")
     * @Assert\Length(min=10, minMessage="attachments_en_gb.too_short_content")
     */
    private $attachments;

    /**
     * @return string
     */
    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject(string $object): void
    {
        $this->object = $object;
    }


}
