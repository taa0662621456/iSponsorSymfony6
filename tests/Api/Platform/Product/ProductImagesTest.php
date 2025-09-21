<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ProductImagesTest extends JsonApiTestCase
{
    public function testItGetsOneProductImage(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['product/product_image.yaml', 'authentication/api_administrator.yaml']);
        /** @var ProductImageInterface $productImage */
        $productImage = $fixtures['product_thumbnail'];

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

    public function testItGetsOneFilteredProductImage(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['product/product_image.yaml', 'authentication/api_administrator.yaml']);
        /** @var ProductImageInterface $productImage */
        $productImage = $fixtures['product_thumbnail'];

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/product-images/%s', (string) $productImage->getId()),
            ['filter' => 'sylius_small'],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/product/get_filtered_product_image_response', Response::HTTP_OK);
    }
}
