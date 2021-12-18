<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use App\Entity\Product\ProductAttachment;
use App\Entity\Product\ProductEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProductsFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{

		for ($p = 1; $p <= 26; $p++) {

			$products = new Product();
			$productEnGb = new ProductEnGb();
			$productAttachments = new ProductAttachment();

            $productEnGb->setProductName('Product # ' . $p);
            $productEnGb->setFirstTitle('ProductFT # ' . $p);
            $productEnGb->setMiddleTitle('ProductMT # ' . $p);
            $productEnGb->setLastTitle('ProductLT # ' . $p);

            $productAttachments->setFileName('cover.jpg');
            $productAttachments->setFilePath('/');
            $productAttachments->setProductAttachments($products);


            $products->setProductEnGb($productEnGb);

            $manager->persist($productAttachments);
            $manager->persist($productEnGb);
			$manager->persist($products);
			$manager->flush();

		}
	}

	public function getDependencies(): array
    {
		return array(
			VendorsFixtures::class,
			CategoryFixtures::class,
			ProjectsFixtures::class,
			OrdersStatusFixtures::class,
		);
	}

	/**
	 * @return int
	 */
	public function getOrder(): int
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
