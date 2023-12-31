<?php

namespace App\Service\DataTransformer;

use Webmozart\Assert\Assert;
use Doctrine\Common\Collections\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

final class TaxonsToCodesTransformer implements DataTransformerInterface
{
    public function __construct(private TaxonRepositoryInterface $taxonRepository)
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

        return new ArrayCollection($this->taxonRepository->findBy(['code' => $value]));
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function reverseTransform($value): array
    {
        Assert::isInstanceOf($value, Collection::class);

        return array_map(fn (TaxonInterface $taxon) => $taxon->getCode(), $value->toArray());
    }
}
