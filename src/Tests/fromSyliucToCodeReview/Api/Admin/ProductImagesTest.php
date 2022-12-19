<?php


namespace App\Tests\Api\Admin;


use SyliusInterface $productImage */
        $productImage = $fixtures["product_thumbnail"];

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
            sprintf('product-images/%s', (string) $productImage->getId()),
            [],
            [],
            array_merge($header, self::CONTENT_TYPE_HEADER)
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'admin/get_product_image_response', Response::HTTP_OK);
    }
}
