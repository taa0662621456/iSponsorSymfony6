<?php

namespace App\Interface;
interface ProductInterface
{
    public function getProductSDesc(): string;

    public function setProductSDesc(string $productSDesc): void;

    public function getProductDesc(): string;

    public function setProductDesc(string $productDesc): void;

    public function getProductName(): string;

    public function setProductName(string $productName): void;
}
