<?php

namespace App\DTO\Category;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class CategoryAttachmentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Category $categoryAttachmentCategory;

    // ManyToOne
    public function getCategoryAttachmentCategory(): Category
    {
        return $this->categoryAttachmentCategory;
    }

    public function setCategoryAttachmentCategory(Category $categoryAttachment): void
    {
        $this->categoryAttachmentCategory = $categoryAttachment;
    }
}
