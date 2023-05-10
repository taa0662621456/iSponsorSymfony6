<?php

namespace App\Factory\Address;

use App\Service\Object\ObjectFactory;

class AddressFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}

