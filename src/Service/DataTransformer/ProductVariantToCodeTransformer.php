<?php


namespace App\Service\DataTransformer;

use App\Interface\Product\ProductVariantInterface;
use App\Interface\Product\ProductVariantRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


use Symfony\Component\Form\DataTransformerInterface;
use Webmozart\Assert\Assert;

final class ProductVariantToCodeTransformer implements DataTransformerInterface
{
    public function __construct(private readonly ProductVariantRepositoryInterface $productVariantRepository)
    {
    }

    /** @throws \InvalidArgumentException */
    public function transform($value): Collection
    {
        Assert::nullOrIsArray($value);

        if (empty($value)) {
            return new ArrayCollection();
        }

        return new ArrayCollection($this->productVariantRepository->findBy(['code' => $value]));
    }

    /** @throws \InvalidArgumentException */
    public function reverseTransform($value): array
    {
        Assert::isInstanceOf($value, Collection::class);

        return array_map(function (ProductVariantInterface $productVariant) {
            return $productVariant->getCode();
        }, $value->toArray());
    }
}
