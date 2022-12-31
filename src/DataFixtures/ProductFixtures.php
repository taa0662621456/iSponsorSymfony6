<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


final class ProductFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        for ($i = 1; $i <= 3; $i++) {

            $product = new Product();
            #
            $productType = $this->getReference('productType_' . $i);
            $productEnGb = $this->getReference('productEnGb_' . $i);
            $productAttachment = $this->getReference('productAttachment_' . $i);
            $productTag = $this->getReference('productTag_' . $i);
            $productReview = $this->getReference('productReview_' . $i);
            #
            $product->setFirstTitle($faker->realText());
            $product->setLastTitle($faker->realText(7000));
            #
            #
            $product->setProductType($productType);
            $product->setProductEnGb($productEnGb);
            $product->setProductCategory($i);
            #
            $product->addProductAttachment($productAttachment);
            $product->addProductTag($productTag);
            $product->addProductReview($productReview);
            #
            $manager->persist($product);
            #
            $this->addReference('product_' . $i, $product);
            #
        }
        $manager->flush();
	}

	public function getDependencies(): array
    {
		return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,
            #
            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            CategoryCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectPlatformRewardFixtures::class,
            #
            ProductAttachmentFixtures::class,
            ProductReviewFixtures::class,
            ProductTagFixtures::class,
            ProductTypeFixtures::class,
            ProductEnGbFixtures::class,

        ];
	}

	public function getOrder(): int
    {
		return 23;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['product'];
	}
}
