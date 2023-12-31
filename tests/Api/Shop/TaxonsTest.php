<?php

namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class TaxonsTest extends JsonApiTestCase
{
    public function testItGetsTaxonomyList(): void
    {
        $this->loadFixturesFromFile('taxonomy.yaml');

        $this->client->request('GET', '/api/v2/shop/taxons', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_taxonomy_response', Response::HTTP_OK);
    }
}
