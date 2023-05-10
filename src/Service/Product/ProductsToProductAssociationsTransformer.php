<?php

namespace App\Service\Product;

use App\Interface\Fixture\FixtureFactoryInterface;
use App\Interface\Product\ProductAssociationTypeRepositoryInterface;
use App\Interface\Product\ProductInterface;
use App\Interface\Product\ProductRepositoryInterface;
use App\Interface\RepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;

final class ProductsToProductAssociationsTransformer implements DataTransformerInterface
{
    /**
     * @var Collection|ProductAssociationTypeRepositoryInterface
     *
     * @psalm-var Collection<array-key, ProductAssociationInterface>
     */
    private Collection|ProductAssociationTypeRepositoryInterface $productAssociations;

    public function __construct(
        private readonly FixtureFactoryInterface    $productAssociationFactory,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly RepositoryInterface        $productAssociationTypeRepository,
    ) {
    }

    public function transform($value): array|string
    {
        $this->setProductAssociations($value);

        if (null === $value) {
            return '';
        }

        $values = [];

        /** @var ProductAssociationTypeRepositoryInterface $productAssociation */
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

            /** @var ProductAssociationTypeRepositoryInterface $productAssociation */
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

    private function getProductAssociationByTypeCode(string $productAssociationTypeCode): ProductAssociationTypeRepositoryInterface
    {
        foreach ($this->productAssociations as $productAssociation) {
            if ($productAssociationTypeCode === $productAssociation->getType()->getCode()) {
                return $productAssociation;
            }
        }

        /** @var ProductAssociationTypeRepositoryInterface $productAssociationType */
        $productAssociationType = $this->productAssociationTypeRepository->findOneBy([
            'code' => $productAssociationTypeCode,
        ]);

        /** @var ProductAssociationTypeRepositoryInterface $productAssociation */
        $productAssociation = $this->productAssociationFactory->createNew();
        $productAssociation->setType($productAssociationType);

        return $productAssociation;
    }

    private function setAssociatedProductsByProductCodes(
        ProductAssociationTypeRepositoryInterface $productAssociation,
        string                                    $productCodes,
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
