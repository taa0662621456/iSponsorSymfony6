<?php

namespace App\Entity\Category;

use App\Entity\ObjectSuperEntity;
use App\Interface\Category\CategoryAttachmentInterface;
use App\Interface\Category\CategoryInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Category\CategoryAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'category_attachment')]
#[ORM\Entity(repositoryClass: CategoryAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
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
