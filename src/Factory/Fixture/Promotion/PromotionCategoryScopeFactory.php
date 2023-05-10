<?php

namespace App\Factory\Fixture\Promotion;

use App\Service\Fixture\FixtureFactory;

class PromotionCategoryScopeFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
