<?php
declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Product\ProductTag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductTagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{
        $projectTagTitle = [
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

        for ($i = 0; $i < count($projectTagTitle); $i++) {

            $productTag = new ProductTag();
            #
            $productTag->setFirstTitle($projectTagTitle[$i]);
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
            CategoriesCategoryFixtures::class,
            CategoryFixtures::class,
            #
            ProjectAttachmentFixtures::class,
            ProjectReviewFixtures::class,
            ProjectTagFixtures::class,
            ProductTypeFixtures::class,
            ProjectEnGbFixtures::class,
            ProjectFixtures::class,
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
		return ['project'];
	}
}
