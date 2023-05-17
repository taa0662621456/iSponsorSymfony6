<?php

namespace App\Dto\Category;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class CategoryAttachmentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private CategoryDTO $categoryAttachmentCategoryDTO;

    // ManyToOne
    public function getCategoryAttachmentCategory(): CategoryDTO
    {
        return $this->categoryAttachmentCategory;
    }

    public function setCategoryAttachmentCategory(CategoryDTO $categoryAttachment): void
    {
        $this->categoryAttachmentCategory = $categoryAttachment;
    }
}
