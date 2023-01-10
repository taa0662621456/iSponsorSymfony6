<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\AttachmentTrait;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Product\ProductAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_attachment')]
#[ORM\Index(columns: ['slug'], name: 'product_attachment_idx')]
#[ORM\Entity(repositoryClass: ProductAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class ProductAttachment
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use AttachmentTrait;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $productAttachmentProduct;

    // ManyToOne
    public function getProductAttachmentProduct(): Product
    {
        return $this->productAttachmentProduct;
    }

    public function setProductAttachmentProduct(Product $product): void
    {
        $this->productAttachmentProduct = $product;
    }
}
