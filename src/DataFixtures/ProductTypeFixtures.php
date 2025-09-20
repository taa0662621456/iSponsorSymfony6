<?php

namespace App\DataFixtures;

use App\Entity\Product\ProductType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductTypeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
	{
        $productTypeTitle = [
            'new',
            'social',
            'star',
            'popular'
        ];

		for ($i = 0; $i < count($productTypeTitle); $i++) {

            $productType = new ProductType();


            $productType->setFirstTitle($productTypeTitle[$i]);
            $productType->setMiddleTitle($productTypeTitle[$i]);
            $productType->setLastTitle($productTypeTitle[$i]);

            $manager->persist($productType);

            $this->setReference('projectType_' . $i, $productType);
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
            CategoriesCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
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
