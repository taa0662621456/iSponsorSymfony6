<?php

namespace App\DataFixtures;

use App\Entity\Product\ProductAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{

        $faker = Factory::create();

		for ($i = 1; $i <= 3; $i++) {

            $productAttachment = new ProductAttachment();

            $productAttachment->setFirstTitle('some file');
            #
            $manager->persist($productAttachment);

            $this->addReference('productAttachment' . $i, $productAttachment);
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
            ProductTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
            #

        ];
    }

	public function getOrder(): int
    {
		return 18;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
