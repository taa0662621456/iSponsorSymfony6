<?php

use Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ProductImagesTest extends JsonApiTestCase
{
    public function testItDeniesAccessToAProductImagesListForNotAuthenticatedUser(): void
    {
        $this->loadFixturesFromFile('product/product_image.yaml');

        $this->client->request('GET', '/api/v2/admin/product-images');

        $response = $this->client->getResponse();
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testItGetsAllProductImages(): void
    {
        $this->loadFixturesFromFiles(['product/product_image.yaml', 'authentication/api_administrator.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/admin/authentication-token',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'],
            json_encode(['email' => 'api@example.com', 'password' => 'sylius'])
        );

        $token = json_decode($this->client->getResponse()->getContent(), true)['token'];
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');

        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;

        $this->client->request(
            'GET',
            'product-images',
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER)
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'admin/get_product_images_response', Response::HTTP_OK);
    }

    public function testItGetsOneProductImage(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['product/product_image.yaml', 'authentication/api_administrator.yaml']);
        /** @var ProductImageInterface $productImage */
        $productImage = $fixtures['product_thumbnail'];

        $this->client->request(
            'POST',
            '/api/v2/admin/authentication-token',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'],
            json_encode(['email' => 'api@example.com', 'password' => 'sylius'])
        );

        $token = json_decode($this->client->getResponse()->getContent(), true)['token'];
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');

        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;

        $this->client->request(
            'GET',
            sprintf('product-images/%s', (string) $productImage->getId()),
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER)
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'admin/get_product_image_response', Response::HTTP_OK);
    }
}
