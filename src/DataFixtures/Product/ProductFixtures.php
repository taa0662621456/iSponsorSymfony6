<?php

namespace App\DataFixtures\Product;



use App\DataFixtures\Category\CategoryAttachmentFixtures;
use App\DataFixtures\Category\CategoryCategoryFixture;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Project\ProjectEnGbFixtures;
use App\DataFixtures\Project\ProjectPlatformRewardFixtures;
use App\DataFixtures\Project\ProjectReviewFixtures;
use App\DataFixtures\Project\ProjectTagFixtures;
use App\DataFixtures\Project\ProjectTypeFixtures;
use App\DataFixtures\Vendor\VendorDocumentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Vendor\VendorMediaFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;
use App\Entity\Product\Product;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;



final class ProductFixtures extends DataFixtures
{


    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property, $n);
    }

	public function getOrder(): int
    {
		return 23;
	}

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->booleanNode('enabled')->end()
            ->booleanNode('tracked')->end()
            ->scalarNode('slug')->end()
            ->scalarNode('short_description')->cannotBeEmpty()->end()
            ->scalarNode('description')->cannotBeEmpty()->end()
            ->scalarNode('main_taxon')->cannotBeEmpty()->end()
            ->arrayNode('taxons')->scalarPrototype()->end()->end()
            ->variableNode('channels')
            ->beforeNormalization()
            ->ifNull()->thenUnset()
            ->end()
            ->end()
            ->scalarNode('variant_selection_method')->end()
            ->arrayNode('product_attributes')->variablePrototype()->end()->end()
            ->arrayNode('product_options')->scalarPrototype()->end()->end()
            ->arrayNode('images')->variablePrototype()->end()->end()
            ->booleanNode('shipping_required')->end()
            ->scalarNode('tax_category')->end()
        ;
    }

}
