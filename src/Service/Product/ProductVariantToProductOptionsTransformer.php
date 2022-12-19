<?php

namespace App\Service\Product;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

final class ProductVariantToProductOptionsTransformer implements DataTransformerInterface
{
    public function __construct(private readonly ProductInterface $product)
    {
    }

    /**
     * @throws UnexpectedTypeException
     */
    public function transform($value): array
    {
        if (null === $value) {
            return [];
        }

        if (!$value instanceof ProductVariantInterface) {
            throw new UnexpectedTypeException($value, ProductVariantInterface::class);
        }

        return array_combine(
            array_map(
                fn (ProductOptionValueInterface $productOptionValue): string => (string) $productOptionValue->getOptionCode(),
                $value->getOptionValues()->toArray(),
            ),
            $value->getOptionValues()->toArray(),
        );
    }

    public function reverseTransform($value): ?ProductVariantInterface
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_array($value) && !$value instanceof \Traversable && !$value instanceof \ArrayAccess) {
            throw new UnexpectedTypeException($value, '\Traversable or \ArrayAccess');
        }

        return $this->matches(is_array($value) ? $value : iterator_to_array($value));
    }

    /**
     * @param array $optionValues
     * @return ProductVariantInterface
     */
    private function matches(array $optionValues): ProductVariantInterface
    {
        foreach ($this->product->getVariants() as $variant) {
            foreach ($optionValues as $optionValue) {
                if (null === $optionValue || !$variant->hasOptionValue($optionValue)) {
                    continue 2;
                }
            }

            return $variant;
        }

        throw new TransformationFailedException(sprintf(
            'Variant "%s" not found for product %s',
            !empty($optionValues[0]) ? $optionValues[0]->getCode() : '',
            $this->product->getCode(),
        ));
    }
}
