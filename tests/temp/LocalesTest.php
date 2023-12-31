<?php

use Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class LocalesTest extends JsonApiTestCase
{
    public function testItGetsLocalesAsLoggedInAdministrator(): void
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

        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;

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

    public function testItDeniesAccessToALocalesListForNotAuthenticatedUser(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'authentication/api_administrator.yaml']);

        $this->client->request('GET', '/api/v2/admin/locales');

        $response = $this->client->getResponse();
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}
