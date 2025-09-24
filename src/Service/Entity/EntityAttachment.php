<?php

namespace App\Service\Entity;

class EntityAttachment
{
    public function getEntityAttachmentClassName(string $entityClassName): ?string
    {
        $attachmentClassName = $entityClassName . 'Attachment';
        return class_exists($attachmentClassName) ? $attachmentClassName : null;
    }

    public function createEntityAttachmentObject(string $attachmentClassName): object
    {
        if (!class_exists($attachmentClassName)) {
            throw new \InvalidArgumentException("Attachment class $attachmentClassName does not exist.");
        }

        return new $attachmentClassName();
    }

}