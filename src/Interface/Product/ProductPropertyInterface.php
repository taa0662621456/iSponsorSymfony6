<?php

namespace App\Interface\Product;

use Symfony\Component\Form\Extension\Core\Type\NumberType;

interface ProductPropertyInterface
{
    public function getProductWeight(): NumberType|float|null;

    public function setProductWeight(float $productWeight): void;

    public function getProductWidth(): float|NumberType|null;

    public function setProductWidth(float|NumberType|null $productWidth): void;

    public function getProductHeight(): NumberType|float|null;

    public function setProductHeight(float $productHeight): void;

    public function getProductLength(): NumberType|float|null;

    public function setProductLength(float $productLength): void;

    public function getProductWeightUom(): float|NumberType|null;

    public function setProductWeightUom(float|NumberType|null $productWeightUom): void;

    public function getProductWidthUom(): float|NumberType|null;

    public function setProductWidthUom(float|NumberType|null $productWidthUom): void;

    public function getProductHeightUom(): float|NumberType|null;

    public function setProductHeightUom(float|NumberType|null $productHeightUom): void;

    public function getProductLengthUom(): float|NumberType|null;

    public function setProductLengthUom(float|NumberType|null $productLengthUom): void;
}
