<?php

namespace App\DataFixtures;

use App\Entity\Project\ProjectReview;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ProjectReviewFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 1; $i <= 26; $i++) {

            $projectReview = new ProjectReview();

            $projectReview->setProjectId($i);
            #
            $projectReview->setFirstTitle($faker->realText());
            $projectReview->setLastTitle($faker->realText(600));
            #
            $projectReview->setWorkFlow('published');
            #
            $manager->persist($projectReview);
            #
            $this->addReference('projectReview_' . $i, $projectReview);
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

        ];
    }

    public function getOrder(): int
    {
        return 13;
    }

    public static function getGroups(): array
    {
        return ['review'];
    }


}
