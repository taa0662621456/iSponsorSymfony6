<?php
namespace App\Tests\Integration\Order;

use App\Entity\Order\OrderStorage;
use App\Entity\Order\OrderStatusHistory;
use App\Enum\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderPersistenceTest extends KernelTestCase
{
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->em = static::getContainer()->get(EntityManagerInterface::class);

        // очищаем таблицы перед тестом
        $this->em->createQuery('DELETE FROM App\Entity\Order\OrderStatusHistory')->execute();
        $this->em->createQuery('DELETE FROM App\Entity\Order\OrderStorage')->execute();
    }

    public function testOrderLifecyclePersistsHistory(): void
    {
        $order = new OrderStorage();
        $this->em->persist($order);
        $this->em->flush();

        // 1. pay()
        $order->pay('tester1');
        $this->em->flush();

        // 2. ship()
        $order->ship('tester2');
        $this->em->flush();

        // 3. complete()
        $order->complete('tester3');
        $this->em->flush();

        // Загружаем из базы
        $repoOrder = $this->em->getRepository(OrderStorage::class)->find($order->getId());
        $repoHistory = $this->em->getRepository(OrderStatusHistory::class)->findBy(['order' => $order], ['changedAt' => 'ASC']);

        // Проверяем текущий статус
        $this->assertSame(OrderStatus::COMPLETED, $repoOrder->getStatus());

        // Проверяем историю
        $this->assertCount(3, $repoHistory);

        $this->assertSame(OrderStatus::NEW,       $repoHistory[0]->getOldStatus());
        $this->assertSame(OrderStatus::PAID,      $repoHistory[0]->getNewStatus());
        $this->assertSame('tester1',              $repoHistory[0]->getChangedBy());

        $this->assertSame(OrderStatus::PAID,      $repoHistory[1]->getOldStatus());
        $this->assertSame(OrderStatus::SHIPPED,   $repoHistory[1]->getNewStatus());
        $this->assertSame('tester2',              $repoHistory[1]->getChangedBy());

        $this->assertSame(OrderStatus::SHIPPED,   $repoHistory[2]->getOldStatus());
        $this->assertSame(OrderStatus::COMPLETED, $repoHistory[2]->getNewStatus());
        $this->assertSame('tester3',              $repoHistory[2]->getChangedBy());
    }
}
