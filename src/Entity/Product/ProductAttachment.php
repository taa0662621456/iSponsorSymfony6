<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\AttachmentTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductAttachmentInterface;

#[ORM\Entity]
class ProductAttachment extends RootEntity implements ObjectInterface, ProductAttachmentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productAttachmentProduct;
}
