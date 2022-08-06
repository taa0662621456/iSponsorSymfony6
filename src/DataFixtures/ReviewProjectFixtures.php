<?php

namespace App\DataFixtures;

use App\Entity\Review\ReviewProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewProjectFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 26; $p++) {

            $review = 'Review Review Review Review';

            $projectReview = new ReviewProject();


            $projectReview->setProjectId($p);
            $projectReview->setWorkFlow('published');
            $projectReview->setReview($review);

            $manager->persist($projectReview);
            $manager->flush();
        }
    }

    public function getDependencies (): array
    {
        return [
            VendorFixtures::class,
            AttachmentFixtures::class,

        ];
    }

    public function getOrder(): int
    {
        return 3;
    }

    public static function getGroups(): array
    {
        return ['review'];
    }


}
