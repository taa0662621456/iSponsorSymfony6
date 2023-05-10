<?php

namespace App\Factory\Fixture\Taxation;

use App\Service\Fixture\FixtureFactory;

final class TaxationCategoryFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
