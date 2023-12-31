<?php

namespace Controller;

use ApiTestCase\JsonApiTestCase;

final class XFrameOptionsTest extends JsonApiTestCase
{
    public function testItSetsFrameOptionsHeader(): void
    {
        $this->client->request('GET', '/');

        $response = $this->client->getResponse();

        $this->assertSame('sameorigin', $response->headers->get('X-Frame-Options'));
    }
}
