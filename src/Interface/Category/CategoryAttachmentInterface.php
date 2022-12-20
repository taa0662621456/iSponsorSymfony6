<?php

namespace App\Interface;

use App\Entity\Category\Category;
use Google\Collection;

interface CategoryAttachmentInterface
{
    # ManyToOne
    public function getCategoryAttachment(): Collection;
    public function setCategoryAttachment(Category $categoryAttachment): void;


}
