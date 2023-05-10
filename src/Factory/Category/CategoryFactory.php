<?php

namespace App\Factory\Category;

use App\Service\Object\ObjectFactory;

class CategoryFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
