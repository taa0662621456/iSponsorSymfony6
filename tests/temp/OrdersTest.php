<?php

use Api\JsonApiTestCase;

use Symfony\Component\HttpFoundation\Response;

final class OrdersTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;
    use OrderPlacerTrait;

    public function testItGetsAnOrder(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;
        $header = array_merge($header, self::CONTENT_TYPE_HEADER);

        $tokenValue = 'nAWw2jewpA';

        $this->placeOrder($tokenValue);

        $this->client->request('GET', '/api/v2/admin/orders/nAWw2jewpA', [], [], $header);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'admin/get_order_response', Response::HTTP_OK);
    }
}
