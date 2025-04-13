<?php

namespace App\Service\Entity;

class EntityAttachment
{
    public function __construct(
        private readonly string $attachmentNamespaceBase = 'App\Entity\\Attachments\\') {}

    public function getAttachmentClass(string $entityClass): ?string
    {
        $attachmentClass = $entityClass . 'Attachment';
        return class_exists($attachmentClass) ? $attachmentClass : null;
    }

    public function createAttachment(string $attachmentClass): object
    {
        if (!class_exists($attachmentClass)) {
            throw new \InvalidArgumentException("Attachment class $attachmentClass does not exist.");
        }

        return new $attachmentClass();
    }

}
