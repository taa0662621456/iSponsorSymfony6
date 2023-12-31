<?php

use Api\JsonApiTestCase;
use Utils\AdminUserLoginTrait;
use Symfony\Component\HttpFoundation\Response;

final class ProductTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;

    public function testItReturnsProductsCollection(): void
    {
        $this->loadFixturesFromFiles(['product/product_variant_with_original_price.yaml', 'authentication/api_administrator.yaml']);

        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;
        $header = array_merge($header, self::CONTENT_TYPE_HEADER);

        $this->client->request(
            'GET',
            '/api/v2/admin/products',
            [],
            [],
            $header
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/get_products_collection_response',
            Response::HTTP_OK
        );
    }

    public function testItReturnsProductItem(): void
    {
        $this->loadFixturesFromFile('authentication/api_administrator.yaml');
        $fixtures = $this->loadFixturesFromFile('product/product_variant_with_original_price.yaml');

        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;
        $header = array_merge($header, self::CONTENT_TYPE_HEADER);

        /** @var ProductInterface $product */
        $product = $fixtures['product_mug'];
        $this->client->request(
            'GET',
            sprintf('/api/v2/admin/products/%s', $product->getCode()),
            [],
            [],
            $header
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/get_product_response',
            Response::HTTP_OK
        );
    }
}
