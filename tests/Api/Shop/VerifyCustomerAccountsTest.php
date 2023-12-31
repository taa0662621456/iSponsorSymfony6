<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Api\Shop;

use Sylius\Tests\Api\JsonApiTestCase;
use Sylius\Tests\Api\Utils\ShopUserLoginTrait;
use Symfony\Component\HttpFoundation\Response;

final class VerifyCustomerAccountsTest extends JsonApiTestCase
{
    use ShopUserLoginTrait;

    public function testItResendsAccountVerificationToken(): void
    {
        self::getContainer();

        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'authentication/customer.yaml']);
        $token = $this->logInShopUser('oliver@doe.com');

        $this->client->request(
            'POST',
            '/api/v2/shop/account-verification-requests',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
                'HTTP_Authorization' => sprintf('Bearer %s', $token),
            ],
            '{}'
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_ACCEPTED);
        self::assertEmailCount(1);
        self::assertEmailAddressContains(self::getMailerMessage(), 'To', 'oliver@doe.com');
    }

    public function testItDoesNotAllowToResendTokenForNotLoggedInUsers(): void
    {
        self::getContainer();

        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'authentication/customer.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/account-verification-requests',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
            ],
            '{}'
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_UNAUTHORIZED);
        self::assertEmailCount(0);
    }
}
