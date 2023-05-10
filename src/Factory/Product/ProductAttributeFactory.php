<?php

namespace App\Factory\Product;

use App\Service\Object\ObjectFactory;

class ProductAttributeFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
