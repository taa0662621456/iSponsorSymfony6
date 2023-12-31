<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\Utils\ShopUserLoginTrait;
use App\Tests\Api\tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class CustomersTest extends JsonApiTestCase
{
    use ShopUserLoginTrait;

    public function testItReturnsSmallAmountOfDataOnCustomerUpdate(): void
    {
        $loadedData = $this->loadFixturesFromFiles(['authentication/customer.yaml']);
        $token = $this->logInShopUser('oliver@doe.com');

        /** @var CustomerInterface $customer */
        $customer = $loadedData['customer_oliver'];

        $this->client->request(
            'PUT',
            '/api/v2/shop/customers/'.$customer->getId(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
                'HTTP_Authorization' => sprintf('Bearer %s', $token),
            ],
            json_encode([
                'firstName' => 'John',
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/update_customer_response', Response::HTTP_OK);
    }

    public function testItRegistersCustomers(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/customers',
            [],
            [],
            self::CONTENT_TYPE_HEADER,
            json_encode([
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'shop@example.com',
                'password' => 'sylius',
                'subscribedToNewsletter' => true,
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_NO_CONTENT);
    }

    public function testItAllowsCustomerToLogIn(): void
    {
        $this->loadFixturesFromFiles(['authentication/customer.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/authentication-token',
            [],
            [],
            self::CONTENT_TYPE_HEADER,
            json_encode([
                'email' => 'oliver@doe.com',
                'password' => 'sylius',
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/log_in_customer_response', Response::HTTP_OK);
    }

    public function testItAllowsCustomerToUpdateItsData(): void
    {
        $loadedData = $this->loadFixturesFromFiles(['authentication/customer.yaml']);
        $token = $this->logInShopUser('oliver@doe.com');

        /** @var CustomerInterface $customer */
        $customer = $loadedData['customer_oliver'];

        $this->client->request(
            'PUT',
            '/api/v2/shop/customers/'.$customer->getId(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
                'HTTP_Authorization' => sprintf('Bearer %s', $token),
            ],
            json_encode([
                'email' => 'john.wick@tarasov.mob',
                'firstName' => 'John',
                'lastName' => 'Wick',
                'gender' => 'm',
                'subscribedToNewsletter' => true,
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/updated_gender_customer_response', Response::HTTP_OK);
    }
}
