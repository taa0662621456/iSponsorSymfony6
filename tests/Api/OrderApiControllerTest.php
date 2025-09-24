<?php
namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class OrderApiControllerTest extends WebTestCase
{
    public function testCreateOrder(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [
                ['product' => '/api/products/1', 'quantity' => 2]
            ]
        ]));

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('total', $data);
    }

    public function testShowOrderNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders/999999');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    public function testOrderPayAndCompleteFlow(): void
    {
        $client = static::createClient();

        // Сначала создаём заказ
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [
                ['product' => '/api/products/1', 'quantity' => 1]
            ]
        ]));
        $data = json_decode($client->getResponse()->getContent(), true);
        $orderId = $data['id'];

        // Оплачиваем заказ
        $client->request('POST', "/api/orders/{$orderId}/pay");
        $this->assertResponseIsSuccessful();

        // Завершаем заказ
        $client->request('POST', "/api/orders/{$orderId}/complete");
        $this->assertResponseIsSuccessful();
    }

    public function testOrderItemsPaymentsShipments(): void
    {
        $client = static::createClient();

        // Создаём заказ
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [
                ['product' => '/api/products/1', 'quantity' => 1]
            ]
        ]));
        $data = json_decode($client->getResponse()->getContent(), true);
        $orderId = $data['id'];

        // Проверяем items
        $client->request('GET', "/api/orders/{$orderId}/items");
        $this->assertResponseIsSuccessful();

        // Проверяем payments
        $client->request('GET', "/api/orders/{$orderId}/payments");
        $this->assertResponseIsSuccessful();

        // Проверяем shipments
        $client->request('GET', "/api/orders/{$orderId}/shipments");
        $this->assertResponseIsSuccessful();
    }
}
