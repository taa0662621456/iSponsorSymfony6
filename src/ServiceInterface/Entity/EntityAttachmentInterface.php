<?php

namespace App\ServiceInterface\Entity;

interface EntityAttachmentInterface
{
    public function getEntityAttachmentNamespace(): string;
    public function getEntityAttachmentClassName(): string;
    public function createEntityAttachmentObject(): object;
}
