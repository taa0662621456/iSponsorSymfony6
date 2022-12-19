<?php


namespace App\Tests\Api\Admin;


use SyliusInterface $channel */
        $channel = $fixtures['channel_web'];

        $header = $this->getLoggedHeader();

        $this->client->request(
            'PUT',
            '/api/v2/admin/channels/' . $channel->getCode(),
            [],
            [],
            $header,
            json_encode([
                'shippingAddressInCheckoutRequired' => true,
            ], JSON_THROW_ON_ERROR)
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
        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');
        $header['HTTP_' . $authorizationHeader] = 'Bearer ' . $token;

        return array_merge($header, self::CONTENT_TYPE_HEADER);
    }
}
