<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase as BaseJsonApiTestCase;

abstract class JsonApiTestCase extends BaseJsonApiTestCase
{
    public const CONTENT_TYPE_HEADER = ['CONTENT_TYPE' => 'application/ld+json', 'HTTP_ACCEPT' => 'application/ld+json'];

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dataFixturesPath = __DIR__.'/DataFixtures/ORM';
        $this->expectedResponsesPath = __DIR__.'/Responses/Expected';
    }

    protected function get($id)
    {
        if (property_exists(static::class, 'container')) {
            return self::$kernel->getContainer()->get($id);
        }

        return parent::get($id);
    }

    protected function getAuthorizationHeaderAsCustomer(string $email, string $password): array
    {
        $this->client->request(
            'POST',
            '/api/v2/shop/authentication-token',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'],
            json_encode(['email' => $email, 'password' => $password])
        );
        $this->assertResponseStatusCodeSame(200);

        $token = json_decode($this->client->getResponse()->getContent(), true)['token'];
        $this->assertIsString($token);

        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');
        $this->assertIsString($authorizationHeader);

        return ['HTTP_'.$authorizationHeader => 'Bearer '.$token];
    }
}
