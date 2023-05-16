<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Category\CategoryInterface;
use App\Interface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
final class CategoryAttachment extends ObjectSuperEntity implements ObjectInterface, CategoryAttachmentInterface
{
    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachment')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
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
