<?php

namespace App\DataFixtures\Product;

use App\DataFixtures\AbstractDataFixture;
use App\Interface\Product\ProductInterface;
use App\Interface\Product\ProductRepositoryInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SimilarProductAssociationFixture extends AbstractDataFixture
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private readonly AbstractFixture $productAssociationTypeFixture,
        private readonly AbstractFixture $productAssociationFixture,
        private readonly ProductRepositoryInterface $productRepository,
    ) {
        parent::__construct();
        $this->faker = Factory::create();
        $this->optionsResolver =
            (new OptionsResolver())
                ->setRequired('amount')
                ->setAllowedTypes('amount', 'int')
        ;
    }

    public function getName(): string
    {
        return 'similar_product_association';
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $options = $this->optionsResolver->resolve((array) $manager);

        $this->productAssociationTypeFixture->load(['custom' => [
            [
                'code' => 'similar_products',
                'name' => 'Similar products',
            ],
        ]]);

        $products = $this->productRepository->findAll();
        $products = $this->faker->randomElements($products, $options['amount']);

        $productAssociations = [];
        foreach ($products as $product) {
            $productAssociations[] = [
                'type' => 'similar_products',
                'owner' => $product->getCode(),
                'associated_products' => $this->getAssociatedProductsAsArray($product),
            ];
        }

        $this->productAssociationFixture->load(['custom' => $productAssociations]);
    }


    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->integerNode('amount')->isRequired()->min(0)->end()
        ;
    }

    /**
     * @return array|string[]
     */
    private function getAssociatedProductsAsArray(ProductInterface $owner): array
    {
        $products = $this->productRepository->findBy(['mainTaxon' => $owner->getMainTaxon()]);
        $products = $this->faker->randomElements($products, 2);

        $associatedProducts = [];
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $associatedProducts[] = $product->getCode();
        }

        return $associatedProducts;
    }
}
