<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
class CategoryAttachment extends ObjectSuperEntity implements ObjectInterface, CategoryAttachmentInterface
{
    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachment')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Category $categoryAttachmentCategory;
}
