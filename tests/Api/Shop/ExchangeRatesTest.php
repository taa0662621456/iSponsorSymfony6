<?php

namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ExchangeRatesTest extends JsonApiTestCase
{
    public function testItGetsExchangeRates(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'exchange_rate.yaml']);

        $this->client->request('GET', '/api/v2/shop/exchange-rates', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_exchange_rates_response', Response::HTTP_OK);
    }

    public function testItGetsAnExchangeRateWithSourceCurrencyTheSameAsTheChannelBaseCurrency(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'exchange_rate.yaml']);

        $this->client->request('GET', sprintf('/api/v2/shop/exchange-rates/%d', $fixtures['exchange_rate_USDPLN']->getId()), [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_exchange_rate_usdpln_response', Response::HTTP_OK);
    }

    public function testItGetsAnExchangeRateWithTargetCurrencyTheSameAsTheChannelBaseCurrency(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'exchange_rate.yaml']);

        $this->client->request('GET', sprintf('/api/v2/shop/exchange-rates/%d', $fixtures['exchange_rate_CNYUSD']->getId()), [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_exchange_rate_cnyusd_response', Response::HTTP_OK);
    }

    public function testItCannotGetAnExchangeRateThatIsNotRelatedToTheChannelBaseCurrency()
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'exchange_rate.yaml']);

        $this->client->request('GET', sprintf('/api/v2/shop/exchange-rates/%d', $fixtures['exchange_rate_GBPBTN']->getId()), [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_NOT_FOUND);
    }
}
