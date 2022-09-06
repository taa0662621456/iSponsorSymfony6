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
        $categoryAttach = $this->getReference(AttachmentFixtures::ATTACHMENT_COLLECTION);

        $categoryCollection = new ArrayCollection();

		for ($p = 1; $p <= 26; $p++) {

			$category = new Category();
            // EnGb vunesti v ondelnu fikcturu
			$categoryEnGb = new CategoryEnGb();
			$categoryAttachment = new CategoryAttachment();

            $categoryCollection->add($category);

            $category->setOrdering($p);
            $category->setCategoryEnGb($categoryEnGb);

            $categoryEnGb->setCategoryName('Category #' . $p);
            $categoryEnGb->setFirstTitle('Category #' . $p);
            $categoryEnGb->setMiddleTitle('Category #' . $p);
            $categoryEnGb->setLastTitle('Category #' . $p);

            $categoryAttachment->setFirstTitle('some file');

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
