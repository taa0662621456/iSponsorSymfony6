<?php


namespace Controller;

use ApiTestCase\JsonApiTestCase;

final class XFrameOptionsTest extends JsonApiTestCase
{
    /** @test */
    public function it_sets_frame_options_header(): void
    {
        $this->client->request('GET', '/');

        $response = $this->client->getResponse();

        $this->assertSame('sameorigin', $response->headers->get('X-Frame-Options'));
    }
}
