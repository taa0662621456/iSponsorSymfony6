<?php


namespace Shop;


use SyliusInterface $review */
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
