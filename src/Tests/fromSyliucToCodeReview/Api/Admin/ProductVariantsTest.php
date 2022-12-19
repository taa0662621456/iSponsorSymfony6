<?php


namespace App\Tests\Api\Admin;




use SyliusInterface $productVariant */
        $productVariant = $fixtures['product_variant'];
        /** @var ChannelInterface $channel */
        $channel = $fixtures['channel_web'];

        $this->client->request(
            'PUT',
            sprintf('/api/v2/admin/product-variants/%s', $productVariant->getCode()),
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER),
            json_encode([
                'channelPricings' => ['WEB' => [
                    '@id' => sprintf('/api/v2/admin/channel-pricings/%s', $productVariant->getChannelPricingForChannel($channel)->getId()),
                    'price' => 3000,
                    'originalPrice' => 4000,
                ]]
            ], JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/put_product_variant_response',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_creates_product_variant(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'product/product_variant.yaml', 'authentication/api_administrator.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/admin/authentication-token',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'],
            json_encode(['email' => 'api@example.com', 'password' => 'isponsor'])
        );

        $token = json_decode($this->client->getResponse()->getContent(), true)['token'];
        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');

        $header['HTTP_' . $authorizationHeader] = 'Bearer ' . $token;

        /** @var ProductInterface $product */
        $product = $fixtures['product'];

        $this->client->request(
            'POST',
            '/api/v2/admin/product-variants',
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER),
            json_encode([
                'code' => 'MUG_2',
                'position' => 1,
                'product' => sprintf('/api/v2/admin/products/%s', $product->getCode()),
                'channelPricings' => ['WEB' => [
                    'channelCode' => 'WEB',
                    'price' => 4000,
                    'originalPrice' => 5000,
                    'minimumPrice' => 2000,
                ]]
            ], JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/post_product_variant_response',
            Response::HTTP_CREATED
        );
    }
}
