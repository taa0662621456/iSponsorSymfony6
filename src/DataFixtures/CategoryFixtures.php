<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
		for ($p = 1; $p <= 26; $p++) {

			$category = new Category();
			$categoryEnGb = new CategoryEnGb();
			$categoryAttachments = new CategoryAttachment();

            $category->setOrdering($p);
            $category->setCategoryEnGb($categoryEnGb);

            $categoryEnGb->setCategoryName('Category #' . $p);
            $categoryEnGb->setFirstTitle('Category #' . $p);
            $categoryEnGb->setMiddleTitle('Category #' . $p);
            $categoryEnGb->setLastTitle('Category #' . $p);

            $categoryAttachments->setFileName('cover.jpg');
            $categoryAttachments->setFilePath('/');
            $categoryAttachments->setFileLayoutPosition('homepage');
            $categoryAttachments->setCategoryAttachments($category);

            $manager->persist($categoryAttachments);
            $manager->persist($categoryEnGb);
            $manager->persist($category);
            $manager->flush();
		}
	}

	public function getDependencies (): array
    {
		return array (
			VendorsFixtures::class,
		);
	}

	public function getOrder(): int
    {
		return 2;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['categories'];
	}
}
