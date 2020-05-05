<?php


namespace App\DataFixtures;


use App\Entity\Review\ProjectReviews\ProjectReviews;
use Doctrine\Persistence\ObjectManager;

class ProjectReviewFixtures
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 26; $p++)

            $review = '
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review 
            Review Review Review Review ';

        $projectReview = new ProjectReviews();


        $projectReview->setProjectId($p);
        $projectReview->setReview($review);

        $manager->persist($projectReview);
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            ProjectsFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['projects'];
    }


}