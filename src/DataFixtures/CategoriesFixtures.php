<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Category\Categories;
use App\Entity\Category\CategoriesAttachments;
use App\Entity\Category\CategoriesEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class CategoriesFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
		for ($p = 1; $p <= 26; $p++) {

			$categories = new Categories();
			$categoryEnGb = new CategoriesEnGb();
			$categoryAttachments = new CategoriesAttachments();


			$slug = new UuidEncoder();

			try {
				$uuid = Uuid::uuid4();
				$categories->setUuid($uuid);
				$categories->setSlug($slug->encode($uuid));
			} catch (Exception $e) {
			}

			$categories->setOrdering($p);
			$categories->setCategoryEnGb($categoryEnGb);

			$categoryEnGb->setCategoryName('Category #' . $p);

			$categoryAttachments->setFileName('cover.jpg');
			$categoryAttachments->setFilePath('/');
			$categoryAttachments->setFileLayoutPosition('homepage');
			$categoryAttachments->setCategoryAttachments($categories);

			$manager->persist($categoryAttachments);
			$manager->persist($categoryEnGb);
			$manager->persist($categories);
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
