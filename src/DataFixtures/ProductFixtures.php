<?php

namespace App\DataFixtures;

use App\Entity\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ProductFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {

            $product = new Product();
            #
            $productType = $this->getReference('productType_' . $i);
            $productEnGb = $this->getReference('productEnGb_' . $i);
            $productAttachment = $this->getReference('productAttachment_' . $i);
            $productCategory = $this->getReference('productCategory_' . $i);
            $productTag = $this->getReference('productTag_' . $i);
            $productPlatformReward = $this->getReference('productPlatformReward_' . $i);
            $productReview = $this->getReference('productReview_' . $i);
            #
            $product->setFirstTitle($faker->realText());
            $product->setLastTitle($faker->realText(7000));
            #
            #
            $product->setProductType($productType);
            $product->setProductEnGb($productEnGb);
            $product->setProductFeatured(1);
            $product->setProductCategory($productCategory);
            #
            $product->addProductAttachment($productAttachment);
            $product->addProductTag($productTag);
            $product->addProductFavorite(true);
            $product->addProductPlatformReward($productPlatformReward);
            $product->addProductReviw($productReview);

            $manager->persist($product);

            $this->addReference('product_' . $i, $product);
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
            CategoriesCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProjectTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
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
