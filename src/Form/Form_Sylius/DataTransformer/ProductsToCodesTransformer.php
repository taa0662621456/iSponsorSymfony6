<?php


namespace App\CoreBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


use Symfony\Component\Form\DataTransformerInterface;
use Webmozart\Assert\Assert;

final class ProductsToCodesTransformer implements DataTransformerInterface
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function transform($value): Collection
    {
        Assert::nullOrIsArray($value);

        if (empty($value)) {
            return new ArrayCollection();
        }

        return new ArrayCollection($this->productRepository->findBy(['code' => $value]));
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function reverseTransform($value): array
    {
        Assert::isInstanceOf($value, Collection::class);

        $productCodes = [];

        /** @var ProductInterface $product */
        foreach ($value as $product) {
            $productCodes[] = $product->getCode();
        }

        return $productCodes;
    }
}
