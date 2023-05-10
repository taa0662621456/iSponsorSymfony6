<?php

namespace App\Factory\Fixture\Promotion;


use App\Service\Fixture\FixtureFactory;

class PromotionCategoryActionFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
