<?php

namespace App\Factory\Fixture\Payment;

use App\Service\Fixture\FixtureFactory;

final class PaymentMethodFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
