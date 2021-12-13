<?php

namespace App\Interface;

use App\Entity\Category\CategoryAttachment;

interface CategoryAttachmentInterface
{

    /**
     * @return CategoryAttachment
     */
	public function getCategoryAttachments(): CategoryAttachment;

	/**
	 * @param CategoryAttachment $categoryAttachments
	 */
	public function setCategoryAttachments(CategoryAttachment $categoryAttachments): void;

    /**
     * @param CategoryAttachmentInterface $attachment
     */
    public function removeCategoryAttachment(CategoryAttachmentInterface $attachment): void;

    /**
     * @param CategoryAttachmentInterface $attachments
     */
    public function addCategoryAttachment(CategoryAttachmentInterface $attachments): void;

}
