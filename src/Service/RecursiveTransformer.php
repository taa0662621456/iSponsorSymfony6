<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class RecursiveTransformer implements DataTransformerInterface
{
    private DataTransformerInterface $decoratedTransformer;

    public function __construct(DataTransformerInterface $decoratedTransformer)
    {
        $this->decoratedTransformer = $decoratedTransformer;
    }

    /** @param Collection|null $value */
    public function transform($value): ArrayCollection
    {
        if (null === $value) {
            return new ArrayCollection();
        }

        $this->assertTransformationValueType($value);

        return $value->map(
            function ($currentValue) {
                return $this->decoratedTransformer->transform($currentValue);
            },
        );
    }

    /** @param Collection|null $value */
    public function reverseTransform($value): ArrayCollection
    {
        if (null === $value) {
            return new ArrayCollection();
        }

        $this->assertTransformationValueType($value);

        return $value->map(
            function ($currentValue) {
                return $this->decoratedTransformer->reverseTransform($currentValue);
            },
        );
    }

    /**
     * @throws TransformationFailedException
     */
    private function assertTransformationValueType(mixed $value): void
    {
        //        if (!($value instanceof Collection::class)) {
        //            throw new TransformationFailedException(
        //                sprintf(
        //                    "Expected %s, but got %s",
        //                    Collection::class,
        //                    is_object($value) ? get_class($value) : gettype($value),
        //                ),
        //            );
        //        }
    }
}
