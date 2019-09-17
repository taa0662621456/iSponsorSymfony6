<?php

namespace App\DataFixtures;

use App\Entity\Category\Categories;
use App\Entity\Category\CategoriesAttachments;
use App\Entity\Category\CategoriesEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
    	// Parent categories
    	for ($p=1; $p <= 26; $p++) {
			$categories = new Categories();
			$categoryEnGb = new CategoriesEnGb();
			$categoryAttachments = new CategoriesAttachments();

			$categories->setOrdering($p);
			$categoryEnGb->setCategoryName('Category #' . $p);
			$categoryEnGb->setSlug($p);
			$categoryAttachments->setFile('cover.jpg');
			$categoryAttachments->setFileUrl('/');

			$manager->persist($categories);
			$manager->persist($categoryEnGb);
			$manager->persist($categoryAttachments);
			$manager->flush();
		}
    }


	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['categories'];
	}
}
