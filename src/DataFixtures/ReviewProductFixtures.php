<?php

namespace App\DataFixtures;


use App\Entity\Review\ReviewProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReviewProductFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($p = 1; $p <= 26; $p++) {

            $review = 'Review Review Review Review';
            //TODO: тип поля $review необходимо изменить на text

            $productReview = new ReviewProduct();


            $productReview->setProductId($p);
            $productReview->setWorkFlow('published');
            $productReview->setReview($review);

            $manager->persist($productReview);
            $manager->flush();
        }
    }


    public function getOrder(): int
    {
        return 100;
    }

    public static function getGroups(): array
    {
        return ['review'];
    }
}
