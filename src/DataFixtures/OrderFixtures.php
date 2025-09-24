<?php

namespace App\DataFixtures;

use App\Entity\Order\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public const ORDER_REF = 'test_order';

    public function load(ObjectManager $manager): void
    {
        $order = new Order();
        if (method_exists($order, 'setStatus')) {
            $order->setStatus('NEW');
        }
        $manager->persist($order);
        $this->addReference(self::ORDER_REF, $order);
        $manager->flush();
    }
}
