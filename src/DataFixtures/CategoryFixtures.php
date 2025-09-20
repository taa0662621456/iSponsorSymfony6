<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager)
	{
        $faker = Factory::create();


		for ($i = 1; $i <= 26; $i++) {

			$category = new Category();

            $category->setOrdering($i);

            $manager->persist($category);

            $this->addReference('category_' . $i, $category);
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
            #

        ];
	}

	public function getOrder(): int
    {
		return 11;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['category'];
	}
}
