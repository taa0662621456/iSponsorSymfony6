<?php

namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class CountriesTest extends JsonApiTestCase
{
    public function testItGetsCountries(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'country.yaml']);

        $this->client->request('GET', '/api/v2/shop/countries', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_countries_response', Response::HTTP_OK);
    }

    public function testItGetsACountry(): void
    {
        $this->loadFixturesFromFiles(['country.yaml']);

        $this->client->request('GET', '/api/v2/shop/countries/FR', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_country_response', Response::HTTP_OK);
    }
}
