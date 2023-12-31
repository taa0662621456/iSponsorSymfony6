<?php

namespace App\Tests\Api\Shop;

use Symfony\Component\HttpFoundation\Response;

final class ProductAssociationTypesTest extends JsonApiTestCase
{
    public function testItGetsProductAssociationType(): void
    {
        $fixtures = $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        /** @var ProductAssociationTypeInterface $associationType */
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
            sprintf('/api/v2/shop/product-association-types/%s', 'wrong input'),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
