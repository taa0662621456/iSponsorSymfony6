<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductReview;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductReviewFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $product = $this->getReference('product_1');

        $review = new ProductReview();
        $review->setRating(4);
        $review->setComment('Great TV, excellent picture quality!');
        $review->setProduct($product);

        $manager->persist($review);
        $this->addReference('productReview_1', $review);

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 60; }
}