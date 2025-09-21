<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class VendorChannelTest extends JsonApiTestCase
{
    const CONTENT_TYPE_HEADER = '';

    public function testItGetsCollectionWithSingleDefaultChannel(): void
    {
        $this->loadFixturesFromFile('channel.yaml');

        $this->client->request('GET', '/api/v2/shop/channels', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_channels_response', Response::HTTP_OK);
    }

    public function testItGetsErrorIfNoChannelFound(): void
    {
        $this->client->request('GET', '/api/v2/shop/channels', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testItGetsChannelByCode(): void
    {
        $this->loadFixturesFromFile('channel.yaml');

        $this->client->request('GET', '/api/v2/shop/channels/WEB', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_channel_by_code_response', Response::HTTP_OK);
    }
}
