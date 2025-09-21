<?php

namespace App\Tests\Api\Shop;

use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Vendor\VendorInterface;
use App\Tests\Api\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

final class AddressesGetTest extends JsonApiTestCase
{
    const CONTENT_TYPE_HEADER = ['CONTENT_TYPE' => 'application/json'];

    public function testItDeniesAccessToGetAddressListForNotAuthenticatedUser(): void
    {
        $this->loadFixturesFromFiles(['authentication/customer.yaml']);

        $this->client->request('GET', '/api/v2/shop/addresses', [], [], self::CONTENT_TYPE_HEADER);

        $response = $this->client->getResponse();
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testItReturnsAddressListOfAnAuthorizedUser(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['address_with_customer.yaml']);
        /** @var VendorInterface $vendor */
        $vendor = $fixtures['customer_tony'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer(
            $vendor->getEmailCanonical(),
            'plainPassword'
        );

        $this->client->request(
            'GET',
            '/api/v2/shop/addresses',
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER)
        );

        $this->assertResponse($this->client->getResponse(), 'shop/get_addresses_response');
    }

    public function testItReturnsAnAddressOfTheAuthorizedUser(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['address_with_customer.yaml']);
        /** @var VendorInterface $customer */
        $customer = $fixtures['customer_tony'];
        /** @var AddressInterface $address */
        $address = $fixtures['address'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer(
            $customer->getEmailCanonical(),
            'sylius'
        );

        $this->client->request(
            'GET',
            '/api/v2/shop/addresses/' . $address->getId(),
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER)
        );

        $this->assertResponse($this->client->getResponse(), 'shop/get_an_address_response');
    }
}
