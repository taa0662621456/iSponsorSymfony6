<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Entity\Product\Product;
use App\Interface\Object\ObjectApiResourceInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

final class ProductPriceDTO extends ObjectDTO implements ObjectApiResourceInterface
{

    private int $productId = 0;

    private int $shopperGroupId = 0;

    #[Assert\Range(
        minMessage: 'The price must be superior to 0',
        maxMessage: 'The price can\'t be more than 1M',
        min: 0, max: 1000000)]
    #[Ignore]
    private Product|float $productPrice = -1.0;

    private ?bool $override = null;

    private ?int $productOverridePrice = null;

    private ?int $productTaxId = null;

    private ?int $productDiscountId = null;

    private ?int $productCurrency = null;

    private string $productPricePublishUp;

    private string $productPricePublishDown;

    private int $priceQuantityStart = 0;

    private int $priceQuantityEnd = 0;

    public function getShopperGroupId(): int
    {
        return $this->shopperGroupId;
    }

    public function setShopperGroupId(int $shopperGroupId): void
    {
        $this->shopperGroupId = $shopperGroupId;
    }

    public function getProductPrice(): int
    {
        return $this->productPrice;
    }

    /**
     * @param $productPrice
     */
    public function setProductPrice($productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    public function getOverride(): ?bool
    {
        return $this->override;
    }

    public function setOverride(?bool $override): void
    {
        $this->override = $override;
    }

    public function getProductOverridePrice(): ?int
    {
        return $this->productOverridePrice;
    }

    /**
     * @param $productOverridePrice
     */
    public function setProductOverridePrice($productOverridePrice): void
    {
        $this->productOverridePrice = $productOverridePrice;
    }

    public function getProductTaxId(): ?int
    {
        return $this->productTaxId;
    }

    public function setProductTaxId(?int $productTaxId): void
    {
        $this->productTaxId = $productTaxId;
    }

    public function getProductDiscountId(): ?int
    {
        return $this->productDiscountId;
    }

    public function setProductDiscountId(?int $productDiscountId): void
    {
        $this->productDiscountId = $productDiscountId;
    }

    public function getProductCurrency(): ?int
    {
        return $this->productCurrency;
    }

    public function setProductCurrency(?int $productCurrency): void
    {
        $this->productCurrency = $productCurrency;
    }

    public function getProductPricePublishUp(): string
    {
        return $this->productPricePublishUp;
    }

    /**
     * @param $productPricePublishUp
     */
    public function setProductPricePublishUp($productPricePublishUp): void
    {
        $this->productPricePublishUp = $productPricePublishUp;
    }

    public function getProductPricePublishDown(): string
    {
        return $this->productPricePublishDown;
    }

    /**
     * @param $productPricePublishDown
     */
    public function setProductPricePublishDown($productPricePublishDown): void
    {
        $this->productPricePublishDown = $productPricePublishDown;
    }

    public function getPriceQuantityStart(): int
    {
        return $this->priceQuantityStart;
    }

    public function setPriceQuantityStart(int $priceQuantityStart): void
    {
        $this->priceQuantityStart = $priceQuantityStart;
    }

    public function getPriceQuantityEnd(): int
    {
        return $this->priceQuantityEnd;
    }

    public function setPriceQuantityEnd(int $priceQuantityEnd): void
    {
        $this->priceQuantityEnd = $priceQuantityEnd;
    }
}
