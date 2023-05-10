<?php

namespace App\Factory\Fixture\Address;

use App\Interface\Fixture\FixtureFactoryInterface;
use App\Service\Fixture\FixtureFactory;

final class AddressFactory extends FixtureFactory implements FixtureFactoryInterface
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
