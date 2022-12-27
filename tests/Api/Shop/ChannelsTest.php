<?php


namespace Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ChannelsTest extends JsonApiTestCase
{
    /** @test */
    public function it_gets_collection_with_single_default_channel(): void
    {
        $this->loadFixturesFromFile('channel.yaml');

        $this->client->request('GET', '/api/v2/shop/channels', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_channels_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_error_if_no_channel_found(): void
    {
        $this->client->request('GET', '/api/v2/shop/channels', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    /** @test */
    public function it_gets_channel_by_code(): void
    {
        $this->loadFixturesFromFile('channel.yaml');

        $this->client->request('GET', '/api/v2/shop/channels/WEB', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_channel_by_code_response', Response::HTTP_OK);
    }
}
