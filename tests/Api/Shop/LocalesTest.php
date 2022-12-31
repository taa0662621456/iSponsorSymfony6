<?php


namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class LocalesTest extends JsonApiTestCase
{
    /** @test */
    public function it_gets_locales(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml']);

        $this->client->request('GET', '/api/v2/shop/locales', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_locales_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_locale(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml']);

        $this->client->request('GET', '/api/v2/shop/locales/en_US', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_locale_response', Response::HTTP_OK);
    }
}
