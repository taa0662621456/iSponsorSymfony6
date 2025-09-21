<?php

namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;

final class ProductOptionTest extends JsonApiTestCase
{
    public function testItReturnsProductOption(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request('GET', '/api/v2/shop/product-options/COLOR', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/product/get_product_option');
    }

    public function testItReturnsProductOptionValue(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request('GET', '/api/v2/shop/product-option-values/COLOR_RED', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/product/get_product_option_value');
    }
}
