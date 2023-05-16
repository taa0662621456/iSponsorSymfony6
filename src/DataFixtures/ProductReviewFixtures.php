<?php

namespace App\DataFixtures;


use App\Entity\Product\ProductReview;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ProductReviewFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 26; $i++) {

            $productReview = new ProductReview();

            $productReview->setFirstTitle($faker->realText());
            $productReview->setLastTitle($faker->realText(1400));
            #
            $productReview->setWorkFlow('published');
            #
            $manager->persist($productReview);
            #
            $this->addReference('productReview_' . $i, $productReview);
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
        ];
    }

    public function getOrder(): int
    {
        return 19;
    }

    public static function getGroups(): array
    {
        return ['review'];
    }
}
