<?php

use Api\JsonApiTestCase;
use Utils\AdminUserLoginTrait;

final class ChannelsTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;

    public function testItCreatesAChannel(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'currency.yaml', 'locale.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/channels',
            [],
            [],
            $header,
            json_encode([
                'name' => 'Web Store',
                'code' => 'WEB',
                'baseCurrency' => '/api/v2/admin/currencies/USD',
                'defaultLocale' => '/api/v2/admin/locales/en_US',
                'taxCalculationStrategy' => 'order_items_based',
                'shippingAddressInCheckoutRequired' => true,

            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/post_channel_response',
            Response::HTTP_CREATED
        );
    }

    public function testItUpdatesAnExistingChannel(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml']);

        /** @var ChannelInterface $channel */
        $channel = $fixtures['channel_web'];

        $header = $this->getLoggedHeader();

        $this->client->request(
            'PUT',
            '/api/v2/admin/channels/'.$channel->getCode(),
            [],
            [],
            $header,
            json_encode([
                'shippingAddressInCheckoutRequired' => true,
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/put_channel_response',
            Response::HTTP_OK
        );
    }

    private function getLoggedHeader(): array
    {
        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;

        return array_merge($header, self::CONTENT_TYPE_HEADER);
    }
}
