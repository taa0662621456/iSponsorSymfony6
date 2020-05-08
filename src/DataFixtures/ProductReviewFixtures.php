<?php

namespace App\DataFixtures;


use App\Entity\Review\ProductReviews\ProductReviews;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductReviewFixtures extends Fixture
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

        $productReview = new ProductReviews();


        $productReview->setProductId($p);
        $productReview->setReview($review);

        $manager->persist($productReview);
        $manager->flush();
    }


    /**
     * @return int
     */
    public function getOrder()
    {
        return 100;
    }

    public static function getGroups(): array
    {
        return ['reviews'];
    }
}
