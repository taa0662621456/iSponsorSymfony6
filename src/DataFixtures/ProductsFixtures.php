<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Product\Products;
use App\Entity\Product\ProductsAttachments;
use App\Entity\Product\ProductsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class ProductsFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{

		for ($p = 1; $p <= 26; $p++) {

			$products = new Products();
			$productEnGb = new ProductsEnGb();
			$productAttachments = new ProductsAttachments();
			$slug = new UuidEncoder();

			try {
				$uuid = Uuid::uuid4();
				$products->setUuid($uuid);
				$products->setSlug($slug->encode($uuid));
			} catch (Exception $e) {
			}


			$products->setProductEnGb($productEnGb);
			$products->addProductAttachment($productAttachments);

			$productEnGb->setProductName('Product # ' . $p);

			$productAttachments->setFile('cover.jpg');
			$productAttachments->setFilePath('/');

			$manager->persist($productAttachments);
			$manager->persist($productEnGb);
			$manager->persist($products);
			$manager->flush();

		}
	}

	public function getDependencies()
	{
		return array(
			VendorsFixtures::class,
			CategoriesFixtures::class,
			ProjectsFixtures::class,
			OrdersStatusFixtures::class,
		);
	}

	/**
	 * @return int
	 */
	public function getOrder()
	{
		return 4;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['products'];
	}
}
