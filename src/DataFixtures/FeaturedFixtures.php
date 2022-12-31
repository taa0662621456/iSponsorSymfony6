<?php

namespace App\DataFixtures;

use App\Entity\Featured\Featured;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class FeaturedFixtures extends Fixture implements DependentFixtureInterface
{

	public function load(ObjectManager $manager)
	{
        for ($i = 1; $i <= 3; $i++) {

            $featured = new Featured();
            #
            $product = $this->getReference('product_' . $i);
            $project = $this->getReference('project_' . $i);
            $category = $this->getReference('category_' . $i);
            $vendor = $this->getReference('vendor_' . $i);
            #
            $featured->setProjectFeatured($project);
            $featured->setProductFeatured($product);
            $featured->setCategoryFeatured($category);
            $featured->setVendorFeatured($vendor);
            #
            $manager->persist($product);
            $manager->persist($project);
            $manager->persist($category);
            $manager->persist($vendor);

            $this->addReference('featured_' . $i, $featured);
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
            ProjectPlatformRewardFixtures::class,
            #
            OrderStatusFixtures::class,
            OrderFixtures::class,
            #

        ];
	}

	public function getOrder(): int
    {
		return 26;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['featured'];
	}
}
