<?php

namespace App\Entity\Category;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\AttachmentTrait;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
class CategoryAttachment extends RootEntity implements ObjectInterface, CategoryAttachmentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachment')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Category $categoryAttachmentCategory;
}
