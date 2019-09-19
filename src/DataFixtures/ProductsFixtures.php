<?php

namespace App\DataFixtures;

use App\Entity\Product\Products;
use App\Entity\Product\ProductsAttachments;
use App\Entity\Product\ProductsEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductsFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {

    	for ($p=1; $p <= 26; $p++) {

			$products = new Products();
			$productEnGb = new ProductsEnGb();
			$productAttachments = new ProductsAttachments();

			$products->setOrdering($p);
			$products->setCreatedBy(0);
			$products->setModifiedBy(0);
			$products->setLockedBy(0);
			$productEnGb->setProductName('Product # ' . $p);
			$productEnGb->setSlug('p' . $p);
			$productAttachments->setFile('cover.jpg');
			$productAttachments->setFileUrl('/');

			$manager->persist($products);
			$manager->persist($productEnGb);
			$manager->persist($productAttachments);
			$manager->flush();

		}
    }


	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['products'];
	}
}
