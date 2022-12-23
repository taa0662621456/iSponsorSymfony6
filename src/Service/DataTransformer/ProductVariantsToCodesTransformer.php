<?php


namespace App\CoreBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


use Symfony\Component\Form\DataTransformerInterface;
use Webmozart\Assert\Assert;

final class ProductVariantsToCodesTransformer implements DataTransformerInterface
{
    public function __construct(private ProductVariantRepositoryInterface $productVariantRepository)
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
