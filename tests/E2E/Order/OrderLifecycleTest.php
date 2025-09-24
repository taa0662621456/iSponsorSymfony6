<?php
namespace App\Tests\E2E\Order;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;

final class OrderLifecycleTest extends WebTestCase
{
    public function testOrderLifecycle(): void
    {
        $client = static::createClient();
        $container = static::getContainer();
        $em = $container->get(EntityManagerInterface::class);

        // 1. Создание заказа через API
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [
                ['product' => '/api/products/1', 'quantity' => 2]
            ]
        ]));

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $data);
        $orderId = $data['id'];

        // 2. Получаем заказ из базы
        $order = $em->getRepository(Order::class)->find($orderId);
        $this->assertInstanceOf(Order::class, $order);

        // 3. Оплата заказа (эмулируем событие order.paid)
        $client->request('POST', "/api/orders/{$orderId}/pay");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // 4. Завершение заказа (эмулируем событие order.completed)
        $client->request('POST', "/api/orders/{$orderId}/complete");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // 5. Проверяем, что Order был финализирован пайплайном
        $em->refresh($order);
        $this->assertNotNull($order->getTotal());
        $this->assertSame('completed', $order->getStatus());
    }
}
