<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CollectionToStringTransformer implements DataTransformerInterface
{
    private string $delimiter;

    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function transform($value): string
    {
        if (!($value instanceof Collection)) {
            throw new TransformationFailedException(
                sprintf(
                    'Expected "%s", but got "%s"',
                    Collection::class,
                    is_object($value) ? get_class($value) : gettype($value),
                ),
            );
        }

        if ($value->isEmpty()) {
            return '';
        }

        return implode($this->delimiter, $value->toArray());
    }

    public function reverseTransform($value): Collection
    {
        if (!is_string($value)) {
            throw new TransformationFailedException(
                sprintf(
                    'Expected string, but got "%s"',
                    is_object($value) ? get_class($value) : gettype($value),
                ),
            );
        }

        if ('' === $value) {
            return new ArrayCollection();
        }

        /** Explode would return string[]|false for PHP 7.4 and string[] for PHP 8 which messes in PHPStan algorithms */
        return new ArrayCollection(explode($this->delimiter, $value) ?: []); // @phpstan-ignore-line
    }

}
