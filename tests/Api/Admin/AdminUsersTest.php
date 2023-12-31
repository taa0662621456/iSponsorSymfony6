<?php

namespace App\Tests\Api\Admin;

use App\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AdminUsersTest extends JsonApiTestCase
{
    public function testItAllowsAdminUsersToLogIn(): void
    {
        $this->loadFixturesFromFile('authentication/api_administrator.yaml');

        $this->client->request(
            'POST',
            '/api/v2/admin/authentication-token',
            [],
            [],
            self::CONTENT_TYPE_HEADER,
            json_encode([
                'email' => 'api@example.com',
                'password' => 'isponsor',
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'admin/log_in_admin_response', Response::HTTP_OK);
    }

    public function testItSendsAdministratorPasswordResetEmail(): void
    {
        $this->loadFixturesFromFile('authentication/api_administrator.yaml');

        $this->client->request(
            Request::METHOD_POST,
            '/api/v2/admin/reset-password-requests',
            [],
            [],
            self::CONTENT_TYPE_HEADER,
            json_encode([
                'email' => 'api@example.com',
            ])
        );

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_ACCEPTED);
    }
}
