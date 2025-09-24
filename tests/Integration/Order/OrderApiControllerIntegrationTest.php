<?php
namespace App\Tests\Integration\Controller\Api;

use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderApiControllerIntegrationTest extends WebTestCase
{
    public function testPayDispatchesOrderPaidEvent(): void
    {
        $client = static::createClient();
        $container = static::getContainer();
        $em = $container->get(EntityManagerInterface::class);

        // Создаём заказ
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [['product' => '/api/products/1', 'quantity' => 1]]
        ]));
        $data = json_decode($client->getResponse()->getContent(), true);
        $orderId = $data['id'];

        // Получаем диспетчер и подписываем тестовый listener
        $dispatcher = $container->get(EventDispatcherInterface::class);
        $captured = null;
        $dispatcher->addListener('order.paid', function (GenericEvent $event) use (&$captured) {
            $captured = $event->getSubject();
        });

        // Оплачиваем заказ
        $client->request('POST', "/api/orders/{$orderId}/pay");
        $this->assertResponseIsSuccessful();

        // Проверяем, что Listener поймал событие
        $this->assertInstanceOf(Order::class, $captured);
        $this->assertSame($orderId, $captured->getId());
    }

    public function testCompleteDispatchesOrderCompletedEvent(): void
    {
        $client = static::createClient();
        $container = static::getContainer();
        $em = $container->get(EntityManagerInterface::class);

        // Создаём заказ
        $client->request('POST', '/api/orders', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'items' => [['product' => '/api/products/1', 'quantity' => 1]]
        ]));
        $data = json_decode($client->getResponse()->getContent(), true);
        $orderId = $data['id'];

        // Получаем диспетчер и подписываем тестовый listener
        $dispatcher = $container->get(EventDispatcherInterface::class);
        $captured = null;
        $dispatcher->addListener('order.completed', function (GenericEvent $event) use (&$captured) {
            $captured = $event->getSubject();
        });

        // Завершаем заказ
        $client->request('POST', "/api/orders/{$orderId}/complete");
        $this->assertResponseIsSuccessful();

        // Проверяем, что Listener поймал событие
        $this->assertInstanceOf(Order::class, $captured);
        $this->assertSame($orderId, $captured->getId());
    }
}
