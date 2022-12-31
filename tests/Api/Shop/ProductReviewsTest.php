<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ProductReviewsTest extends JsonApiTestCase
{
    /** @test */
    public function it_gets_product_review(): void
    {
        $fixtures = $this->loadFixturesFromFile('product/product_review.yaml');

        /** @var ReviewInterface $review */
        $review = $fixtures['customer_review'];

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/product-reviews/%s', $review->getId()),
            [],
            [],
            self::CONTENT_TYPE_HEADER,
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_review',
            Response::HTTP_OK,
        );
    }

    /** @test */
    public function it_gets_product_reviews(): void
    {
        $this->loadFixturesFromFile('product/product_review.yaml');;

        $this->client->request('GET', '/api/v2/shop/product-reviews', [], [], self::CONTENT_TYPE_HEADER);

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_reviews',
            Response::HTTP_OK,
        );
    }
}
