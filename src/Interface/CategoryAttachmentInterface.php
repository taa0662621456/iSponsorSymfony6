<?php

namespace App\Interface;

use App\Entity\Category\CategoryAttachment;

interface CategoryAttachmentInterface
{

    public function getCategoryAttachments(): CategoryAttachment;

	public function setCategoryAttachments(CategoryAttachmentInterface $categoryAttachments): void;

    public function removeCategoryAttachment(CategoryAttachmentInterface $attachment): void;

    public function addCategoryAttachment(CategoryAttachmentInterface $attachments): void;

}
