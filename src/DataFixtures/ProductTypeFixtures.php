<?php

namespace App\DataFixtures;

use App\Entity\Product\ProductType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductTypeFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
	{
        $productTypeMap = [
            'new',
            'social',
            'star',
            'popular',
            'city',
            'sky',
            'hand',
        ];

		for ($i = 1; $i <= count($productTypeMap)-1; $i++) {

            $productType = new ProductType();


            $productType->setFirstTitle($productTypeMap[$i]);
            $productType->setMiddleTitle($productTypeMap[$i]);
            $productType->setLastTitle($productTypeMap[$i]);

            $manager->persist($productType);

            $this->setReference('productType_' . $i, $productType);
        }
        $manager->flush();

    }

	public function getDependencies (): array
    {
		return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,
            #
            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectPlatformRewardFixtures::class,
            #
            ProductAttachmentFixtures::class,
            ProductReviewFixtures::class,
            ProductTagFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 21;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
