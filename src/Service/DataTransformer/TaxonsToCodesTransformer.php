<?php


namespace App\CoreBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


use Symfony\Component\Form\DataTransformerInterface;
use Webmozart\Assert\Assert;

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
