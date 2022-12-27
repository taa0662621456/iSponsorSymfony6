<?php


namespace Shop;






final class ShippingMethodsTest extends JsonApiTestCase
{
    use ShopUserLoginTrait;

    /** @test */
    public function it_gets_all_available_shipping_methods_by_default_in_given_channel(): void // Cover case of shipping methods in other channel
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml']);

        $this->client->request(
            'GET',
            '/api/v2/shop/shipping-methods',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_shipping_methods_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_shipping_methods_available_for_given_shipment_and_order(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml']);

        $tokenValue = 'nAWw2jewpA';
        $customer = 'example@example.com';
        $this->getCartAndPutItemForCustomer($tokenValue, $customer);

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA', [], [], self::CONTENT_TYPE_HEADER);
        $orderResponse = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/shipping-methods?shipmentId=%s&tokenValue=%s', $orderResponse['shipments'][0]['id'], $tokenValue),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_shipping_methods_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_returns_list_of_available_shipping_methods_of_assigned_cart_for_visitor(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/customer.yaml',
            'channel.yaml',
            'cart.yaml',
            'country.yaml',
            'shipping_method.yaml',
        ]);

        $tokenValue = 'nAWw2jewpA';
        $customer = 'oliver@doe.com';

        $this->getCartAndPutItemForCustomer($tokenValue, $customer);

        /** @var ShipmentRepositoryInterface $shipmentRepository */
        $shipmentRepository = $this->get('repository.shipment');

        /** @var ShipmentInterface $shipment */
        $shipment = $shipmentRepository->findOneBy([]);

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/shipping-methods?shipmentId=%s&tokenValue=nAWw2jewpA', $shipment->getId()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_shipping_methods_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_returns_list_of_available_shipping_methods_of_assigned_cart_for_other_users_if_shipment_id_and_cart_provided(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/customer.yaml',
            'channel.yaml',
            'cart.yaml',
            'country.yaml',
            'shipping_method.yaml',
        ]);

        $tokenValue = 'nAWw2jewpA';
        $customer = 'oliver@doe.com';
        $otherCustomer = 'dave@doe.com';

        $this->getCartAndPutItemForCustomer($tokenValue, $customer);

        /** @var ShipmentRepositoryInterface $shipmentRepository */
        $shipmentRepository = $this->get('repository.shipment');

        /** @var ShipmentInterface $shipment */
        $shipment = $shipmentRepository->findOneBy([]);

        $this->logInShopUser($otherCustomer);

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/shipping-methods?shipmentId=%s&tokenValue=nAWw2jewpA', $shipment->getId()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_shipping_methods_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_returns_empty_list_of_available_shipping_methods_for_not_existent_shipment(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/customer.yaml',
            'channel.yaml',
            'cart.yaml',
            'country.yaml',
            'shipping_method.yaml',
        ]);

        $this->client->request(
            'GET',
            '/api/v2/shop/shipping-methods?shipmentId=-10&tokenValue=nAWw2jewpA',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_empty_order_shipping_methods_response', Response::HTTP_OK);
    }

    /** @test */
    public function it_returns_empty_list_of_available_shipping_methods_for_not_existent_order(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/customer.yaml',
            'channel.yaml',
            'cart.yaml',
            'country.yaml',
            'shipping_method.yaml',
        ]);

        $this->client->request(
            'GET',
            '/api/v2/shop/shipping-methods?shipmentId=-10&tokenValue=test',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_empty_order_shipping_methods_response', Response::HTTP_OK);
    }

    private function getCartAndPutItemForCustomer(string $tokenValue, string $customer): void
    {
        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue, 'en_US');
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        $address = new Address();
        $address->setFirstName('John');
        $address->setLastName('Doe');
        $address->setCity('New York');
        $address->setStreet('Avenue');
        $address->setCountryCode('US');
        $address->setPostcode('90000');

        $updateCartCommand = new UpdateCart($customer, $address);
        $updateCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($updateCartCommand);
    }
}
