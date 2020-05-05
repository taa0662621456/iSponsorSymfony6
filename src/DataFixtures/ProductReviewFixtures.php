<?php

namespace App\DataFixtures;


use App\Entity\Review\ProductReviews\ProductReviews;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductReviewFixtures extends Fixture implements DependentFixtureInterface
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
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            ProductsFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['products'];
    }
}