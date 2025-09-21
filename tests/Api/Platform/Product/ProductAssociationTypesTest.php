<?php

namespace App\Tests\Api\Shop;

use App\Form\Product\ProductBundle\ProductAssociationType;
use App\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ProductAssociationTypesTest extends JsonApiTestCase
{
    const CONTENT_TYPE_HEADER = ['CONTENT_TYPE' => 'application/json'];

    public function testItGetsProductAssociationType(): void
    {
        $fixtures = $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        /** @var ProductAssociationType $associationType */
        $associationType = $fixtures['product_association_type'];
        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/product-association-types/%s', $associationType->getCode()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_association_type_response',
            Response::HTTP_OK
        );
    }

    public function testItReturnsNothingIfAssociationTypeNotFound(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request(
            'GET',
            '/api/v2/shop/product-association-types/wrong_code',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testItListsAllAssociationTypes(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request(
            'GET',
            '/api/v2/shop/product-association-types',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        self::assertIsArray($data);
        self::assertNotEmpty($data);
        self::assertArrayHasKey('code', $data[0]);
        self::assertArrayHasKey('name', $data[0]);
    }
}
