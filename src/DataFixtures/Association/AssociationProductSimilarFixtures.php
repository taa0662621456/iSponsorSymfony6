<?php

namespace App\DataFixtures\Association;



use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\Product\ProductTypeFixtures;
use App\Entity\Association\AssociationProduct;
use App\EntityInterface\Product\ProductInterface;
use Faker\Generator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;


final class AssociationProductSimilarFixtures extends DataFixtures
{

    private Generator $faker;

    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        // TODO: Implement load() method.
        parent::load($manager, $property, $n);
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
        $products = $this->productRepository->findBy(['mainTaxon' => $owner->getMainTaxation()]);
        $products = $this->faker->randomElements($products, 2);

        $associatedProducts = [];
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $associatedProducts[] = $product->getCode();
        }

        return $associatedProducts;
    }

}
