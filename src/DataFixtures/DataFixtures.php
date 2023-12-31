<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Vendor\VendorFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Address\AddressFixtures;
use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\Project\ProjectFixtures;
use Symfony\Component\OptionsResolver\Options;
use App\DataFixtures\Category\CategoryFixtures;
use App\DataFixtures\Order\OrderStatusFixtures;
use App\DataFixtures\Shipment\ShipmentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Order\OrderStorageFixtures;
use App\DataFixtures\Product\ProductTagFixtures;
use App\DataFixtures\Project\ProjectTagFixtures;
use App\DataFixtures\Vendor\VendorMediaFixtures;
use App\DataFixtures\Address\AddressCityFixtures;
use App\DataFixtures\Product\ProductEnGbFixtures;
use App\DataFixtures\Product\ProductTypeFixtures;
use App\DataFixtures\Project\ProjectEnGbFixtures;
use App\DataFixtures\Project\ProjectTypeFixtures;
use App\DataFixtures\Promotion\PromotionFixtures;
use Doctrine\Common\DataFixtures\FixtureInterface;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Product\ProductReviewFixtures;
use App\DataFixtures\Project\ProjectReviewFixtures;
use App\DataFixtures\Vendor\VendorDocumentFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;
use App\DataFixtures\Address\AddressCountryFixtures;
use App\DataFixtures\Address\AddressZipcodeFixtures;
use App\DataFixtures\Address\AddressProvinceFixtures;
use App\DataFixtures\Association\AssociationFixtures;
use App\DataFixtures\Shipment\ShipmentMethodFixtures;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\DataFixtures\Address\AddressStreetLineFixtures;
use App\DataFixtures\Product\ProductAttachmentFixtures;
use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Shipment\ShipmentCategoryFixtures;
use App\DataFixtures\Promotion\PromotionCatalogFixtures;
use App\DataFixtures\Category\CategoryAttachmentFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\Association\AssociationProductFixtures;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use App\DataFixtures\Address\AddressStreetSecondLineFixtures;
use App\DataFixtures\Association\AssociationProductTypeFixtures;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

abstract class DataFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{
    public const DATA_FIXTURES = 20;
//
//    private OptionsResolver $optionsResolver;
//
//    public function __construct()
//    {
//        $this->optionsResolver = new OptionsResolver();
//        $this->configureOptions($this->optionsResolver);
//    }
//
    public function load(ObjectManager $manager, ?array $property = [], ?int $n = self::DATA_FIXTURES): void
    {
        $entityClass = $this->getEntityClass();
        $fixtureGroup = $this->getGroups();

        for ($i = 1; $i <= $n; $i++) {
            $resource = new $entityClass($property);

            $manager->persist($resource);
            $this->setReference($this->getReferenceName().'_'.$i, $resource);

            if (0 === $i % 10) {
                $manager->flush();
            }
        }
        $manager->flush();
    }
//
//    public function getConfigTreeBuilder(): TreeBuilder
//    {
//        $treeBuilder = new TreeBuilder($this->getName());
//
//        /** @var ArrayNodeDefinition $optionsNode */
//        $optionsNode = $treeBuilder->getRootNode();
//
//        $class = $this->getEntityClass();
//        $classMetadata = $this->manager->getClassMetadata($class);
//        $this->configureEntityFields($optionsNode, $classMetadata->getFieldNames(), $classMetadata->getAssociationNames());
//
//        return $treeBuilder;
//    }
//
//    protected function configureEntityFields(ArrayNodeDefinition $node, array $fields, array $associations): void
//    {
//        $class = $this->getEntityClass();
//        $classMetadata = $this->manager->getClassMetadata($class);
//
//        foreach ($fields as $field) {
//            $defaultValue = $classMetadata->getFieldValue($this->getReference(static::class), $field);
//            $node->scalarNode($field)->defaultValue($defaultValue)->end();
//        }
//
//        $this->addAssociation($node, $associations);
//    }
//
//    protected function addAssociation(NodeBuilder $node, array $associations): void
//    {
//        foreach ($associations as $association) {
//            $node->arrayNode($association)
//                ->prototype('scalar')->end()
//                ->end();
//        }
//    }
//
//    protected function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefault('random', 0);
//        $resolver->setAllowedTypes('random', 'int');
//        $resolver->setDefault('prototype', []);
//        $resolver->setAllowedTypes('prototype', 'array');
//        $resolver->setDefault('custom', []);
//        $resolver->setAllowedTypes('custom', 'array');
//        $resolver->setNormalizer('custom', function (Options $options, array $custom) {
//            if ($options['random'] <= 0) {
//                return $custom;
//            }
//
//            return array_merge($custom, array_fill(0, $options['random'], $options['prototype']));
//        });
//    }
//
//    public function getName(): string
//    {
//        $className = static::class;
//        $lastSeparator = strrpos($className, '\\');
//        $shortClassName = (false !== $lastSeparator) ? substr($className, $lastSeparator + 1) : $className;
//
//        return preg_replace('/\W.*$/', '', $shortClassName);
//    }
//
    protected function getEntityClass(): string
    {
        $className = static::class;
        $words = preg_split('/(?=[A-Z])/', $className, -1, \PREG_SPLIT_NO_EMPTY);

        $words[1] = 'Entity\\';
        unset($words[2]);
        array_pop($words);

        return implode('', $words);
    }
//
    public static function getGroups(): array
    {
        $className = static::class;
        $shortName = substr($className, strrpos($className, '\\') + 1);
        $matches = [];

        preg_match('/([A-Z][a-z]+)/', $shortName, $matches);

        if (isset($matches[0])) {
            return [lcfirst($matches[0])];
        }

        return [];
    }

    public function getDependencies(): array
    {
        $dependencies = [

            stdClassFixture::class,

            AddressZipcodeFixtures::class,
            AddressProvinceFixtures::class,
            AddressStreetLineFixtures::class,
            AddressStreetSecondLineFixtures::class,
            AddressCityFixtures::class,
            AddressCountryFixtures::class,
            AddressFixtures::class,

            PromotionCatalogFixtures::class,
            PromotionFixtures::class,

            ShipmentCategoryFixtures::class,
            ShipmentMethodFixtures::class,
            ShipmentFixtures::class,

            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,

            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryFixtures::class,

            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectTagFixtures::class,
            ProjectFixtures::class,

            ProductAttachmentFixtures::class,
            ProductReviewFixtures::class,
            ProductTagFixtures::class,
            ProductTypeFixtures::class,
            ProductEnGbFixtures::class,
            ProductFixtures::class,

            AssociationProductTypeFixtures::class,
            AssociationProductFixtures::class,
            AssociationFixtures::class,

            OrderStatusFixtures::class,
            OrderStorageFixtures::class,
        ];

        $fixtureClassName = static::class;

        $classNameIndex = array_search($fixtureClassName, $dependencies);
        if (false !== $classNameIndex) {
            $dependencies = \array_slice($dependencies, 0, $classNameIndex);
        }

        return $dependencies;
    }

    public function getReferenceName(): string
    {
        $resourceName = new \ReflectionClass(static::class);

        return $resourceName->getShortName();
    }
}
