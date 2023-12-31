<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\Utils\ShopUserLoginTrait;
use App\Tests\Api\tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class SendContactRequestTest extends JsonApiTestCase
{
    use ShopUserLoginTrait;

    public function testItSendsContactRequest(): void
    {
        self::getContainer();

        $this->loadFixturesFromFiles(['channel.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/contact-requests',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
            ],
            json_encode([
                'email' => 'customer@email.com',
                'message' => 'Example of message',
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_ACCEPTED);
        self::assertEmailCount(1);
        self::assertEmailAddressContains(self::getMailerMessage(), 'To', 'web@sylius.com');
    }

    public function testItSendsContactRequestAsLoggedInUser(): void
    {
        self::getContainer();

        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'authentication/customer.yaml']);

        /** @var CustomerInterface $customer */
        $customer = $fixtures['customer_oliver'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer($customer->getEmailCanonical(), 'sylius');

        $this->client->request(
            'POST',
            '/api/v2/shop/contact-requests',
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER),
            json_encode([
                'email' => 'customer@email.com',
                'message' => 'Example of message',
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_ACCEPTED);
        self::assertEmailCount(1);
        self::assertEmailAddressContains(self::getMailerMessage(), 'To', 'web@sylius.com');
    }
}
