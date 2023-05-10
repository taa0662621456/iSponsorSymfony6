<?php

namespace App\Interface\Category;

use App\Entity\Category\Category;

interface CategoryAttachmentInterface
{
    // ManyToOne
    public function getCategoryAttachmentCategory(): Category;

    public function setCategoryAttachmentCategory(Category $categoryAttachmentAttachment): void;
}
