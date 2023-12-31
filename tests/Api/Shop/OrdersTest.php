<?php

namespace App\Tests\Api\Shop;

final class OrdersTest extends JsonApiTestCase
{
    use OrderPlacerTrait;
    use ShopUserLoginTrait;

    public function testItGetsAnOrder(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
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

        $updateCartCommand = new UpdateCart('example@example.com', $address);
        $updateCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($updateCartCommand);

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_response', Response::HTTP_OK);
    }

    public function testItGetsAnOrderAsAGuestWithACustomerThatIsAlreadyRegistered(): void
    {
        $this->loadFixturesFromFiles(['authentication/customer.yaml', 'channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
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

        $updateCartCommand = new UpdateCart('oliver@doe.com', $address);
        $updateCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($updateCartCommand);

        $this->client->request(
            method: 'GET',
            uri: '/api/v2/shop/orders/nAWw2jewpA',
            server: self::CONTENT_TYPE_HEADER,
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_response', Response::HTTP_OK);
    }

    public function testItGetsOrderItems(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA/items', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_items_response', Response::HTTP_OK);
    }

    public function testItGetsOrderAdjustments(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA/adjustments', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_adjustments_response', Response::HTTP_OK);
    }

    public function testItGetsOrderItemAdjustments(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        /** @var OrderInterface $order */
        $order = $this->get('repository.order')->findCartByTokenValue($tokenValue);
        $orderItem = $order->getItems()->first();

        /** @var AdjustmentInterface $adjustment */
        $adjustment = $this->get('factory.adjustment')->createNew();

        $adjustment->setType(AdjustmentInterface::ORDER_ITEM_PROMOTION_ADJUSTMENT);
        $adjustment->setAmount(200);
        $adjustment->setNeutral(false);
        $adjustment->setLabel('Test Promotion Adjustment');

        $orderItem->addAdjustment($adjustment);
        $this->get('manager.order')->flush();

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA/items/'.$order->getItems()->first()->getId().'/adjustments', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/get_order_item_adjustments_response', Response::HTTP_OK);
    }

    public function testItAllowsToAddItemsToOrder(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $this->client->request('POST', '/api/v2/shop/orders/nAWw2jewpA/items', [], [], self::CONTENT_TYPE_HEADER, json_encode([
            'productVariant' => '/api/v2/shop/product-variants/MUG_BLUE',
            'quantity' => 3,
        ]));
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/add_item_response', Response::HTTP_CREATED);
    }

    public function testItDoesNotGetOrdersCollectionForGuest(): void
    {
        $this->client->request('GET', '/api/v2/shop/orders', [], [], self::CONTENT_TYPE_HEADER);
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/error/jwt_token_not_found', Response::HTTP_UNAUTHORIZED);
    }

    public function testItAllowsToPatchOrdersPaymentMethod(): void
    {
        $this->loadFixturesFromFiles(['authentication/customer.yaml', 'channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $loginData = $this->logInShopUser('oliver@doe.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$loginData;
        $header = array_merge($header, self::CONTENT_TYPE_HEADER);

        $tokenValue = 'nAWw2jewpA';

        $this->placeOrder($tokenValue, 'oliver@doe.com');

        $this->client->request('GET', '/api/v2/shop/orders/nAWw2jewpA', [], [], $header);
        $orderResponse = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->request(
            'PATCH',
            sprintf('/api/v2/shop/account/orders/nAWw2jewpA/payments/%s', $orderResponse['payments'][0]['id']),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/merge-patch+json',
                'HTTP_Authorization' => sprintf('Bearer %s', $loginData),
            ],
            json_encode([
                'paymentMethod' => '/api/v2/shop/payment-methods/CASH_ON_DELIVERY',
            ])
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/updated_payment_method_on_order_response', Response::HTTP_OK);
    }

    public function testItCreatesEmptyCartWithProvidedLocale(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/orders',
            [],
            [],
            ['CONTENT_TYPE' => 'application/ld+json', 'HTTP_ACCEPT' => 'application/ld+json', 'HTTP_ACCEPT_LANGUAGE' => 'pl_PL'],
            json_encode([])
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/create_cart_response', Response::HTTP_CREATED);
    }

    public function testItCreatesEmptyCartWithDefaultLocale(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml']);

        $this->client->request(
            'POST',
            '/api/v2/shop/orders',
            [],
            [],
            ['CONTENT_TYPE' => 'application/ld+json', 'HTTP_ACCEPT' => 'application/ld+json'],
            json_encode([])
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/create_cart_with_default_locale_response', Response::HTTP_CREATED);
    }

    public function testItAllowsToPatchOrdersAddress(): void
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $tokenValue = 'nAWw2jewpA';

        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue);
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);
        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        /** @var CountryInterface $country */
        $country = $fixtures['country_US'];

        $billingAddress = [
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'phoneNumber' => '666111333',
            'company' => 'Potato Corp.',
            'countryCode' => $country->getCode(),
            'street' => 'Top secret',
            'city' => 'Nebraska',
            'postcode' => '12343',
        ];

        $this->client->request(
            method: 'PUT',
            uri: '/api/v2/shop/orders/nAWw2jewpA',
            server: [
                'CONTENT_TYPE' => 'application/ld+json',
                'HTTP_ACCEPT' => 'application/ld+json',
            ],
            content: json_encode([
                'email' => 'oliver@doe.com',
                'billingAddress' => $billingAddress,
            ])
        );
        $response = $this->client->getResponse();

        $this->assertResponse($response, 'shop/updated_billing_address_on_order_response', Response::HTTP_OK);
    }
}
