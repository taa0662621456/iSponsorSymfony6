<?php

namespace App\DataFixtures;


use App\Entity\Product\ProductReview;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductReviewFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 26; $i++) {

            //TODO: тип поля $review необходимо изменить на text и сделать отношения

            $productReview = new ProductReview();


            $productReview->setWorkFlow('published');
            $productReview->setLastTitle($faker->realText(1400));

            $manager->persist($productReview);

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
            ProjectFixtures::class,
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
