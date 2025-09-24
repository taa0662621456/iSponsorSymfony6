<?php

namespace App\DataFixtures;

use App\Service\OpenAi\OpenAiImageGenerator;
use App\Service\RandomImagePicker;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Vendor\VendorFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Address\AddressFixtures;
use App\DataFixtures\Product\ProductFixtures;
use App\DataFixtures\Project\ProjectFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use App\DataFixtures\Order\OrderStatusFixtures;
use App\DataFixtures\Shipment\ShipmentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Order\OrderStorageFixtures;
use App\DataFixtures\Product\ProductTagFixtures;
use App\DataFixtures\Project\ProjectTagFixtures;
use App\DataFixtures\Vendor\VendorMediaAttachmentFixtures;
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
use App\DataFixtures\Vendor\VendorDocumentAttachmentFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;
use App\DataFixtures\Address\AddressCountryFixtures;
use App\DataFixtures\Address\AddressZipcodeFixtures;
use App\DataFixtures\Address\AddressProvinceFixtures;
use App\DataFixtures\Association\AssociationFixtures;
use App\DataFixtures\Shipment\ShipmentMethodFixtures;
use App\DataFixtures\Address\AddressStreetLineFixtures;
use App\DataFixtures\Product\ProductAttachmentFixtures;
use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Shipment\ShipmentCategoryFixtures;
use App\DataFixtures\Promotion\PromotionCatalogFixtures;
use App\DataFixtures\Category\CategoryAttachmentFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\Association\AssociationProductFixtures;
use App\DataFixtures\Address\AddressStreetSecondLineFixtures;
use App\DataFixtures\Association\AssociationProductTypeFixtures;
use Exception;
use Faker\Factory;
use ReflectionClass;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use function array_slice;
use const PREG_SPLIT_NO_EMPTY;

abstract class DataFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{
    public const DATA_FIXTURES = 20;

    public function __construct(private readonly OpenAiImageGenerator $aiImageGenerator)
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {

        $faker = Factory::create();

        $entityClass = $this->getEntityClass();

        for ($i = 1; $i <= self::DATA_FIXTURES; $i++) {
            $entity = new $entityClass();

            foreach ($property as $propName => $propData) {

                if (is_callable($propData)) {
                    $propValue = $propData($faker, $i);
                } else {
                    $propValue = $propData;
                }

                $setMethod = 'set' . ucfirst($propName);
                if (method_exists($entity, $setMethod)) {
                    $entity->$setMethod($propValue);
                }
            }

            $manager->persist($entity);
            $this->setReference($this->getReferenceName() . '_' . $i, $entity);

            if (0 === $i % 10) {
                $manager->flush();
            }
        }
        $manager->flush();

    }

    protected function getEntityClass(): string
    {
        $className = static::class;
        $words = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);

        $words[1] = 'Entity\\';
        unset($words[2]);
        array_pop($words);

        return implode('', $words);
    }

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

            VendorMediaAttachmentFixtures::class,
            VendorDocumentAttachmentFixtures::class,
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
            $dependencies = array_slice($dependencies, 0, $classNameIndex);
        }

        return $dependencies;
    }

    public function getReferenceName(): string
    {
        $resourceName = new ReflectionClass(static::class);

        return $resourceName->getShortName();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function imageFixtureEngine(?array $property, ?string $size, ?string $path = ''): array
    {
        $randomImagePicked = (new RandomImagePicker())->getRandomImage();

        if (!$randomImagePicked) {
            $aiImage = $this->aiImageGenerator->getOpenAiImageGenerated(
                'user avatar',
                $path,
                $size);

            $aiImageProperty = [
                'fileName' => $aiImage['name'],
                'fileSize' => $aiImage['size'],
                'filePath' => $aiImage['path'],
            ];

            return array_merge($property, $aiImageProperty);

        }

        $aiImageProperty = [
            'fileName' => $randomImagePicked['name'],
            'fileSize' => $randomImagePicked['size'],
            'filePath' => $randomImagePicked['path'],
        ];

        return array_merge($property, $aiImageProperty);

    }

    /**
     * @throws Exception
     */
    public function titleFixtureEngine(string $resource, ?array $property = []): array
    {
        if (!file_exists($resource)) {
            throw new Exception("File '$resource' isn't found.");
        }

        $jsonContent = file_get_contents($resource);
        if ($jsonContent === false) {
            throw new Exception("File didn't read '$resource'.");
        }

        $projects = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON decoding error: " . json_last_error_msg());
        }

        $projectProperty = [];
        if (!empty($projects)) {

            $project = $projects[array_rand($projects)];

            if (isset($project['firstTitle'], $project['middleTitle'])) {
                $projectProperty = [
                    'firstTitle' => $project['firstTitle'],
                    'middleTitle' => $project['middleTitle'],
                ];
            }
        }

        return array_merge($property, $projectProperty);
    }
}