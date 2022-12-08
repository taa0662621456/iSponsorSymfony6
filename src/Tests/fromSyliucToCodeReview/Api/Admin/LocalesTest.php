<?php


namespace App\Tests\Api\Admin;

use Sylius\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class LocalesTest extends JsonApiTestCase
{
    /** @test */
    public function it_gets_locales_as_logged_in_administrator(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'authentication/api_administrator.yaml']);

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

        $this->client->request(
            'GET',
            '/api/v2/admin/locales',
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER)
        );

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'admin/get_locales_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_denies_access_to_a_locales_list_for_not_authenticated_user(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'authentication/api_administrator.yaml']);

        $this->client->request('GET', '/api/v2/admin/locales');

        $response = $this->client->getResponse();
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}
