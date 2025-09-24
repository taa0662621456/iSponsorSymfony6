<?php

namespace App\DataFixtures\Payment;

use App\Entity\Payment\PaymentGateway;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class PaymentGatewayFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $gateway = new PaymentGateway();
        $gateway->setName('Stripe');
        $manager->persist($gateway);
        $this->addReference('paymentGateway_stripe', $gateway);

        $manager->flush();
    }

    public static function getGroup(): string { return 'payment'; }
    public static function getPriority(): int { return 20; }
}
