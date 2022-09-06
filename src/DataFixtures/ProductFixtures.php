<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use App\Entity\Product\ProductAttachment;
use App\Entity\Product\ProductEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_COLLECTION = 'productCollection';

	public function load(ObjectManager $manager)
	{
        $att = $this->getReference(AttachmentFixtures::ATTACHMENT_COLLECTION);
//        $proMedia = $this->getReference()  // вінести отдельно продукт медиа в фикстуру
        $faker = Factory::create();

        $productCollection = new ArrayCollection();

		for ($p = 1; $p <= 26; $p++) {

			$product = new Product();
			$productEnGb = new ProductEnGb();
			$productAttachment = new ProductAttachment();

            $productEnGb->setFirstTitle('Wonderful Product FT # ' . $p);
            $productEnGb->setMiddleTitle($faker->realText(200));
            $productEnGb->setLastTitle($faker->realText(7000));

            $productAttachment->setFirstTitle('some file');
            $productAttachment->setProductAttachmentProduct($product);


            $product->setProductEnGb($productEnGb);

            $manager->persist($productAttachment);
            $manager->persist($productEnGb);
			$manager->persist($product);
			$manager->flush();

            $productCollection->add($product);

		}

        $this->addReference(self::PRODUCT_COLLECTION, $productCollection);
	}

	public function getDependencies(): array
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
            OrderStatusFixtures::class,
            ProjectFixtures::class,
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
		return ['product'];
	}
}
