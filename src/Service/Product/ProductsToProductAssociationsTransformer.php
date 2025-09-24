<?php

namespace App\Service\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;

final class ProductsToProductAssociationsTransformer implements DataTransformerInterface
{
    /**
     * @var Collection|ProductAssociationInterface[]
     *
     * @psalm-var Collection<array-key, ProductAssociationInterface>
     */
    private ?Collection $productAssociations = null;

    public function __construct(
        private FactoryInterface $productAssociationFactory,
        private ProductRepositoryInterface $productRepository,
        private RepositoryInterface $productAssociationTypeRepository,
    ) {
    }

    public function transform($value)
    {
        $this->setProductAssociations($value);

        if (null === $value) {
            return '';
        }

        $values = [];

        /** @var ProductAssociationInterface $productAssociation */
        foreach ($value as $productAssociation) {
            $productCodesAsString = $this->getCodesAsStringFromProducts($productAssociation->getAssociatedProducts());

            $values[$productAssociation->getType()->getCode()] = $productCodesAsString;
        }

        return $values;
    }

    public function reverseTransform($value): ?Collection
    {
        if (null === $value || '' === $value || !is_array($value)) {
            return null;
        }

        /**
         * @psalm-var Collection<array-key, ProductAssociationInterface> $productAssociations
         */
        $productAssociations = new ArrayCollection();
        foreach ($value as $productAssociationTypeCode => $productCodes) {
            if (null === $productCodes) {
                continue;
            }

            /** @var ProductAssociationInterface $productAssociation */
            $productAssociation = $this->getProductAssociationByTypeCode($productAssociationTypeCode);
            $this->setAssociatedProductsByProductCodes($productAssociation, $productCodes);
            $productAssociations->add($productAssociation);
        }

        $this->setProductAssociations(null);

        return $productAssociations;
    }

    private function getCodesAsStringFromProducts(Collection $products): ?string
    {
        if ($products->isEmpty()) {
            return null;
        }

        $codes = [];

        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $codes[] = $product->getCode();
        }

        return implode(',', $codes);
    }

    private function getProductAssociationByTypeCode(string $productAssociationTypeCode): ProductAssociationInterface
    {
        foreach ($this->productAssociations as $productAssociation) {
            if ($productAssociationTypeCode === $productAssociation->getType()->getCode()) {
                return $productAssociation;
            }
        }

        /** @var ProductAssociationTypeInterface $productAssociationType */
        $productAssociationType = $this->productAssociationTypeRepository->findOneBy([
            'code' => $productAssociationTypeCode,
        ]);

        /** @var ProductAssociationInterface $productAssociation */
        $productAssociation = $this->productAssociationFactory->createNew();
        $productAssociation->setType($productAssociationType);

        return $productAssociation;
    }

    private function setAssociatedProductsByProductCodes(
        ProductAssociationInterface $productAssociation,
        string $productCodes,
    ): void {
        $products = $this->productRepository->findBy(['code' => explode(',', $productCodes)]);

        $productAssociation->clearAssociatedProducts();
        foreach ($products as $product) {
            $productAssociation->addAssociatedProduct($product);
        }
    }

    private function setProductAssociations(?Collection $productAssociations): void
    {
        $this->productAssociations = $productAssociations;
    }
}