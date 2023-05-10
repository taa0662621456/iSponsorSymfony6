<?php

namespace App\Factory\Order;

use App\Service\Object\ObjectFactory;

class OrderFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
