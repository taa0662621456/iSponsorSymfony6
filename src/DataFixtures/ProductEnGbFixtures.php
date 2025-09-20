<?php

namespace App\DataFixtures;

use App\Entity\Product\ProductEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductEnGbFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $productEnGb = new ProductEnGb();
            #
            $productEnGb->setFirstTitle($faker->firstName);
            $productEnGb->setLastTitle($faker->lastName);
            #
            $manager->persist($productEnGb);
            #
            $this->addReference('productEnGb_' . $i, $productEnGb);
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
            ProductTypeFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 22;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}
