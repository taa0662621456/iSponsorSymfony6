<?php


namespace App\Tests\Api\Admin;

use Sylius\Tests\Api\JsonApiTestCase;
use Sylius\Tests\Api\Utils\AdminUserLoginTrait;
use Sylius\Tests\Api\Utils\OrderPlacerTrait;
use Symfony\Component\HttpFoundation\Response;

final class PaymentsTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;
    use OrderPlacerTrait;

    /** @test */
    public function it_gets_an_order(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'cart.yaml', 'country.yaml', 'shipping_method.yaml', 'payment_method.yaml']);

        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('api.authorization_header');
        $header['HTTP_' . $authorizationHeader] = 'Bearer ' . $token;
        $header = array_merge($header, self::CONTENT_TYPE_HEADER);

        $tokenValue = 'nAWw2jewpA';

        $this->placeOrder($tokenValue);

        $this->client->request('GET', '/api/v2/admin/orders/nAWw2jewpA', [], [], $header);
        $orderResponse = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->request('GET', '/api/v2/admin/payments/' . $orderResponse['payments'][0]['id'], [], [], $header);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'admin/get_payment_response', Response::HTTP_OK);
    }
}
