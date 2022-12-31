<?php
declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Product\ProductTag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductTagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{
        $productTagTitle = [
            'phone',
            'iphone',
            'share',
            'contract',
            'disk',
            'flower',
            'box',
            'gift',
            'card',
            'deposit',
            'book',
        ];

        for ($i = 1; $i <= count($productTagTitle)-1; $i++) {

            $productTag = new ProductTag();
            #
            $productTag->setFirstTitle($productTagTitle[$i]);
            #
            $manager->persist($productTag);
            #
            $this->addReference('productTag_' . $i, $productTag);
        }
        $manager->flush();

    }

	public function getDependencies (): array
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
        ];
	}

	public function getOrder(): int
    {
		return 20;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['product'];
	}
}
