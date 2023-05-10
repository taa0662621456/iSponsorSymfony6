<?php

namespace App\DataFixtures;

use App\Entity\Category\CategoryEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class CategoryEnGbFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; ++$i) {
            $categoryEnGb = new CategoryEnGb();

            $categoryEnGb->setFirstTitle($faker->firstName);
            $categoryEnGb->setLastTitle($faker->lastName);

            $manager->persist($categoryEnGb);

            $this->addReference('categoryEnGb_'.$i, $categoryEnGb);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,

            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,

            CategoryAttachmentFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 9;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }
}
