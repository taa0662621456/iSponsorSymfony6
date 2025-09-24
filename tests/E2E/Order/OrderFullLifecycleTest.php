<?php
namespace App\Tests\E2E\Order;

use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class OrderFullLifecycleTest extends WebTestCase
{
    public function testFullLifecycle(): void
    {
        $client = static::createClient();
        $container = static::getContainer();
        $em = $container->get(EntityManagerInterface::class);

        // 1. Создание заказа
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [['product' => '/api/products/1', 'quantity' => 1]]
        ]));

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $data = json_decode($client->getResponse()->getContent(), true);
        $orderId = $data['id'];

        // 2. Проверка заказа в БД
        $order = $em->getRepository(Order::class)->find($orderId);
        $this->assertInstanceOf(Order::class, $order);

        // 3. Оплата заказа → триггерит Listener и Pipeline
        $client->request('POST', "/api/orders/{$orderId}/pay");
        $this->assertResponseIsSuccessful();

        $em->refresh($order);
        $this->assertNotNull($order->getTotal());

        // 4. Завершение заказа → триггерит Listener и Pipeline
        $client->request('POST', "/api/orders/{$orderId}/complete");
        $this->assertResponseIsSuccessful();

        $em->refresh($order);
        $this->assertSame('completed', $order->getStatus());

        // 5. Проверяем связанные данные
        $client->request('GET', "/api/orders/{$orderId}/items");
        $this->assertResponseIsSuccessful();

        $client->request('GET', "/api/orders/{$orderId}/payments");
        $this->assertResponseIsSuccessful();

        $client->request('GET', "/api/orders/{$orderId}/shipments");
        $this->assertResponseIsSuccessful();
    }
}
