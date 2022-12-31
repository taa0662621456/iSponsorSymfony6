<?php

namespace App\DataFixtures;

use App\Entity\Product\ProductAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{

		for ($i = 1; $i <= 3; $i++) {

            $productAttachment = new ProductAttachment();

            $productAttachment->setFirstTitle('some file');
            #
            $manager->persist($productAttachment);

            $this->addReference('productAttachment_' . $i, $productAttachment);
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

        ];
    }

	public function getOrder(): int
    {
		return 18;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['project'];
	}
}
