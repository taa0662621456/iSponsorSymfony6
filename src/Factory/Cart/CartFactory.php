<?php

namespace App\Factory\Cart;

use App\Service\Object\ObjectFactory;

class CartFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
