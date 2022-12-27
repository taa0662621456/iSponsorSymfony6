<?php


namespace Shop;


use SyliusInterface $productImage */
        $productImage = $fixtures["product_thumbnail"];

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/product-images/%s', (string) $productImage->getId()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/product/get_product_image_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_one_filtered_product_image(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['product/product_image.yaml', 'authentication/api_administrator.yaml']);
        /** @var ProductImageInterface $productImage */
        $productImage = $fixtures["product_thumbnail"];

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/product-images/%s', (string) $productImage->getId()),
            ['filter' => 'small'],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/product/get_filtered_product_image_response', Response::HTTP_OK);
    }
}
