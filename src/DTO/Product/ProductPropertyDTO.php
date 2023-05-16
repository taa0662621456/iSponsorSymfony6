<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProductPropertyDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private NumberType|float|null $productWeight;

    private NumberType|float|null $productWeightUom = null;

    private NumberType|float|null $productWidth;

    private NumberType|float|null $productWidthUom = null;

    private float $productHeightDTO;

    private NumberType|float|null $productHeightUom = null;

    private float $productLengthDTO;

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
