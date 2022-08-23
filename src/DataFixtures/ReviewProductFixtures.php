<?php

namespace App\DataFixtures;


use App\Entity\Review\ReviewProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const REVIEW_PRODUCT_COLLECTION = 'reviewProductCollection';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $reviewProductCollection = new ArrayCollection();

        for ($p = 1; $p <= 26; $p++) {

            $review = 'Review Review Review Review';
            //TODO: тип поля $review необходимо изменить на text

            $productReview = new ReviewProduct();


            $productReview->setProductId($p);
            $productReview->setWorkFlow('published');
            $productReview->setReview($review);

            $manager->persist($productReview);
            $manager->flush();

            $reviewProductCollection->add($productReview);
        }

        $this->addReference(self::REVIEW_PRODUCT_COLLECTION, $reviewProductCollection);
    }

    public function getDependencies (): array
    {
        return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 4;
    }

    public static function getGroups(): array
    {
        return ['review'];
    }
}
