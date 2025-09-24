<?php

namespace App\DataFixtures\Payment;

use App\Entity\Payment\Payment;
use App\Entity\Payment\PaymentGateway;
use App\Entity\Payment\PaymentMethod;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class PaymentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $gateway = new PaymentGateway();
        $gateway->setName('Stripe');
        $manager->persist($gateway);

        $method = new PaymentMethod();
        $method->setName('Credit Card');
        $method->setGateway($gateway);
        $manager->persist($method);

        $payment = new Payment();
        $payment->setAmount(100);
        $payment->setMethod($method);
        $manager->persist($payment);

        $this->addReference('payment_gateway_stripe', $gateway);
        $this->addReference('payment_method_card', $method);
        $this->addReference('payment_1', $payment);

        $manager->flush();
    }

    public static function getGroup(): string { return 'payment'; }
    public static function getPriority(): int { return 10; }
}
