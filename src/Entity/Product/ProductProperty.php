<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductPropertyInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

#[ORM\Entity]
final class ProductProperty extends ObjectSuperEntity implements ObjectInterface, ProductPropertyInterface
{
    #[ORM\Column(name: 'product_weight', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private NumberType|float|null $productWeight;

    #[ORM\Column(name: 'product_weight_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productWeightUom = null;

    #[ORM\Column(name: 'product_width', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private NumberType|float|null $productWidth;

    #[ORM\Column(name: 'product_width_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productWidthUom = null;

    #[ORM\Column(name: 'product_height', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private float $productHeight;

    #[ORM\Column(name: 'product_height_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productHeightUom = null;

    #[ORM\Column(name: 'product_length', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private float $productLength;

    #[ORM\Column(name: 'product_length_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productLengthUom = null;

    public function getProductWeight(): float
    {
        return $this->productWeight;
    }

    public function setProductWeight(float $productWeight): void
    {
        $this->productWeight = $productWeight;
    }

    public function getProductWidth(): float|NumberType|null
    {
        return $this->productWidth;
    }

    public function setProductWidth(float|NumberType|null $productWidth): void
    {
        $this->productWidth = $productWidth;
    }

    public function getProductHeight(): float
    {
        return $this->productHeight;
    }

    public function setProductHeight(float $productHeight): void
    {
        $this->productHeight = $productHeight;
    }

    public function getProductLength(): float
    {
        return $this->productLength;
    }

    public function setProductLength(float $productLength): void
    {
        $this->productLength = $productLength;
    }

    public function getProductWeightUom(): float|NumberType|null
    {
        return $this->productWeightUom;
    }

    public function setProductWeightUom(float|NumberType|null $productWeightUom): void
    {
        $this->productWeightUom = $productWeightUom;
    }

    public function getProductWidthUom(): float|NumberType|null
    {
        return $this->productWidthUom;
    }

    public function setProductWidthUom(float|NumberType|null $productWidthUom): void
    {
        $this->productWidthUom = $productWidthUom;
    }

    public function getProductHeightUom(): float|NumberType|null
    {
        return $this->productHeightUom;
    }

    public function setProductHeightUom(float|NumberType|null $productHeightUom): void
    {
        $this->productHeightUom = $productHeightUom;
    }

    public function getProductLengthUom(): float|NumberType|null
    {
        return $this->productLengthUom;
    }

    public function setProductLengthUom(float|NumberType|null $productLengthUom): void
    {
        $this->productLengthUom = $productLengthUom;
    }
}
