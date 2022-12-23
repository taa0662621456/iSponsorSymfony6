<?php


namespace App\CoreBundle\Form\DataTransformer;






use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class ProductTaxonToTaxonTransformer implements DataTransformerInterface
{
    public function __construct(
        private FactoryInterface $productTaxonFactory,
        private RepositoryInterface $productTaxonRepository,
        private ProductInterface $product,
    ) {
    }

    public function transform($value): ?TaxonInterface
    {
        if (null === $value) {
            return null;
        }

        $this->assertTransformationValueType($value, ProductTaxonInterface::class);

        return $value->getTaxon();
    }

    public function reverseTransform($value): ?ProductTaxonInterface
    {
        if (null === $value) {
            return null;
        }

        $this->assertTransformationValueType($value, TaxonInterface::class);

        /** @var ProductTaxonInterface|null $productTaxon */
        $productTaxon = $this->productTaxonRepository->findOneBy(['taxon' => $value, 'product' => $this->product]);

        if (null === $productTaxon) {
            /** @var ProductTaxonInterface $productTaxon */
            $productTaxon = $this->productTaxonFactory->createNew();
            $productTaxon->setProduct($this->product);
            $productTaxon->setTaxon($value);
        }

        return $productTaxon;
    }

    /**
     * @throws TransformationFailedException
     */
    private function assertTransformationValueType($value, string $expectedType): void
    {
        if (!($value instanceof $expectedType)) {
            throw new TransformationFailedException(
                sprintf(
                    'Expected "%s", but got "%s"',
                    $expectedType,
                    get_debug_type($value),
                ),
            );
        }
    }
}
