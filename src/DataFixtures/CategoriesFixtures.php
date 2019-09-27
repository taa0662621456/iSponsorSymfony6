<?php

namespace App\DataFixtures;

use App\Entity\Category\Categories;
use App\Entity\Category\CategoriesAttachments;
use App\Entity\Category\CategoriesEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture implements DependentFixtureInterface
//class CategoriesFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
    	// Parent categories
    	for ($p=1; $p <= 26; $p++) {

			$categories = new Categories();
			$categoryEnGb = new CategoriesEnGb();
			$categoryAttachments = new CategoriesAttachments();

			$categories->setOrdering($p);
			$categories->setSlug('slug' . $p);
			$categoryEnGb->setCategoryName('Category #' . $p);
			$categoryAttachments->setFile('cover.jpg');
			$categoryAttachments->setFileUrl('/');

			$manager->persist($categories);
			$manager->persist($categoryEnGb);
			$manager->persist($categoryAttachments);
			$manager->flush();
		}
    }

	public function getDependencies ()
	{
		return array (
			VendorsFixtures::class,
		);
	}
	/**
	 * @return int
	 */
	public function getOrder()
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
