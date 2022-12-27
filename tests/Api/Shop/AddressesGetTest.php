<?php


namespace Shop;



use SyliusInterface $customer */
        $customer = $fixtures['customer_tony'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer($customer->getEmailCanonical(), 'isponsor');

        $this->client->request(
            'GET',
            '/api/v2/shop/addresses',
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER)
        );

        $this->assertResponse($this->client->getResponse(), 'shop/get_addresses_response');
    }

    /** @test */
    public function it_returns_an_address_of_the_authorized_user(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['address_with_customer.yaml']);
        /** @var CustomerInterface $customer */
        $customer = $fixtures['customer_tony'];
        /** @var AddressInterface $address */
        $address = $fixtures['address'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer($customer->getEmailCanonical(), 'isponsor');

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
