<?php

namespace App\Tests\Api\Platform\Address;

use App\Tests\Api\JsonApiTestCase;
use App\EntityInterface\Customer\CustomerInterface;
use Symfony\Component\HttpFoundation\Response;

final class AddressesPostTest extends JsonApiTestCase
{
    const CONTENT_TYPE_HEADER = [
        'CONTENT_TYPE' => 'application/ld+json',
        'HTTP_ACCEPT'  => 'application/json',
    ];

    public function testItDeniesAccessToCreateAddressForNotAuthenticatedUser(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['authentication/customer.yaml', 'country.yaml']);
        /** @var CountryInterface $country */
        $country = $fixtures['country_US'];

        $bodyRequest = $this->createBodyRequest($country->getCode());

        $this->client->request(
            'POST',
            '/api/v2/shop/addresses',
            [],
            [],
            self::CONTENT_TYPE_HEADER,
            json_encode($bodyRequest)
        );

        $response = $this->client->getResponse();
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testItCreatesNewAddressForLoggedCustomer(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['authentication/customer.yaml', 'country.yaml']);
        /** @var CustomerInterface $customer */
        $customer = $fixtures['customer_oliver'];
        /** @var CountryInterface $country */
        $country = $fixtures['country_US'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer($customer->getEmailCanonical(), 'sylius');
        $bodyRequest = $this->createBodyRequest($country->getCode());

        $this->client->request(
            'POST',
            '/api/v2/shop/addresses',
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER),
            json_encode($bodyRequest)
        );

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'shop/create_address_response', Response::HTTP_CREATED);
    }

    private function createBodyRequest(string $countryCode): array
    {
        return [
            'firstName'    => 'TEST',
            'lastName'     => 'TEST',
            'phoneNumber'  => '666111333',
            'company'      => 'Potato Corp.',
            'countryCode'  => $countryCode,
            'provinceCode' => null,
            'provinceName' => null,
            'street'       => 'Top secret',
            'city'         => 'Nebraska',
            'postcode'     => '12343',
        ];
    }
}
