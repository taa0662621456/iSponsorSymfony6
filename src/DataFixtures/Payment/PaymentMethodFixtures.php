<?php

namespace App\DataFixtures\Payment;

use App\Entity\Payment\PaymentMethod;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class PaymentMethodFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $method = new PaymentMethod();
        $method->setName('Credit Card');

        $manager->persist($method);
        $this->addReference('paymentMethod_card', $method);

        $manager->flush();
    }

    public static function getGroup(): string { return 'payment'; }
    public static function getPriority(): int { return 10; }
}

