<?php

namespace App\DataFixturesFactory\Promotion;


use App\DataFixturesFactoryInterface\Promotion\PromotionCategoryActionDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

class PromotionCategoryActionDataFixturesFactory extends DataFixturesFactory implements PromotionCategoryActionDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

}
