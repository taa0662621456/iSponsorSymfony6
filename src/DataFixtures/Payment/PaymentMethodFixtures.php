<?php

namespace App\DataFixtures\Payment;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class PaymentMethodFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => 'PayPal',
        ];

        parent::load($manager, $property);
    }
}
