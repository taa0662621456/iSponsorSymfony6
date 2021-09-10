<?php

namespace App\DataFixtures;

use App\Entity\Review\ReviewProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReviewProjectFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 26; $p++)

            $review = 'Review Review Review Review';

        $projectReview = new ReviewProject();


        $projectReview->setProjectId($p);
        $projectReview->setWorkFlow('published');
        $projectReview->setReview($review);

        $manager->persist($projectReview);
        $manager->flush();
    }


    /**
     * @return int
     */
    public function getOrder()
    {
        return 101;
    }

    public static function getGroups(): array
    {
        return ['reviews'];
    }


}
