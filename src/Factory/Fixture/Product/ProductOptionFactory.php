<?php

namespace App\Factory\Fixture\Product;

use App\Service\Fixture\FixtureFactory;

final class ProductOptionFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
