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
    public const CATEGORY_COLLECTION = 'categoryCollection';

	public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $categoryCollection = new ArrayCollection();

		for ($p = 1; $p <= 26; $p++) {

			$category = new Category();
			$categoryEnGb = new CategoryEnGb();
			$categoryAttachment = new CategoryAttachment();

            $categoryCollection->add($category);

            $category->setOrdering($p);
            $category->setCategoryEnGb($categoryEnGb);
//            $category->addCategoryChildren($categoryRepository);

            $categoryEnGb->setCategoryName('Category #' . $p);
            $categoryEnGb->setFirstTitle('Category #' . $p);
            $categoryEnGb->setMiddleTitle('Category #' . $p);
            $categoryEnGb->setLastTitle('Category #' . $p);

            $categoryAttachment->setFileName('cover.jpg');
            $categoryAttachment->setFilePath('/');
            $categoryAttachment->setFileLayoutPosition('homepage');
//            $categoryAttachment->setCategoryAttachment($category);

            $manager->persist($categoryAttachment);
            $manager->persist($categoryEnGb);
            $manager->persist($category);
            $manager->flush();
		}

        $this->addReference(self::CATEGORY_COLLECTION, $categoryCollection);
	}

	public function getDependencies (): array
    {
		return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
            ReviewProductFixtures::class,
            CategoryAttachmentFixtures::class,
            ProjectTypeFixtures::class,
            ProjectAttachmentFixtures::class,
            ProjectTagFixtures::class,
            ProjectFixtures::class,
            ProductFixtures::class,
            OrderStatusFixtures::class,
            OrderFixtures::class,
        ];
	}

	public function getOrder(): int
    {
		return 14;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['category'];
	}
}
