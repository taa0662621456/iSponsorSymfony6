<?php


namespace App\Tests\Api\Shop;


use SyliusInterface $product */
        $product = $fixtures['product_variant_mug_blue'];
        $this->client->request('GET',
            sprintf('/api/v2/shop/product-variants/%s', $product->getCode()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_variant_with_default_locale_translation',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_returns_nothing_if_variant_not_found(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request('GET',
            '/api/v2/shop/product-variants/NON_EXISTING_VARIANT',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
