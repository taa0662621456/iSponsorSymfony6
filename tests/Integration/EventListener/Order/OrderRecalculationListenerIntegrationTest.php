<?php
namespace App\Tests\Integration\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderRecalculationListener;
use App\Service\Order\OrderManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class OrderRecalculationListenerIntegrationTest extends KernelTestCase
{
    public function testPostPersistTriggersFinalize(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $em = $container->get(EntityManagerInterface::class);

        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize');

        $listener = new OrderRecalculationListener($manager);
        $em->getEventManager()->addEventListener([Events::postPersist], $listener);

        $order = new Order();
        $em->persist($order);
        $em->flush();
    }
}
