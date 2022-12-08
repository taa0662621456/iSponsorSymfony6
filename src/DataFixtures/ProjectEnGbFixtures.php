<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectEnGbFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $projectEnGb = new ProjectEnGb();
            #
            $projectEnGb->setFirstTitle($faker->firstName);
            $projectEnGb->setLastTitle($faker->lastName);
            #
            $manager->persist($projectEnGb);
            #
            $this->addReference('projectEnGb_' . $i, $projectEnGb);
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
        ];
    }

    public function getOrder(): int
    {
        return 16;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}
