<?php

namespace App\Entity\Product;

use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductAttachmentInterface;

#[ORM\Entity]
class ProductAttachment extends ObjectSuperEntity implements ObjectInterface, ProductAttachmentInterface
{
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productAttachmentProduct;
}
