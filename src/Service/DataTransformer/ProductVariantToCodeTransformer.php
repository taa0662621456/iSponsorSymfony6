<?php

namespace App\Service\DataTransformer;

use Webmozart\Assert\Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Interface\Product\ProductVariantInterface;

use Symfony\Component\Form\DataTransformerInterface;
use App\Interface\Product\ProductVariantRepositoryInterface;

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
