<?php

namespace App\DataFixturesFactory\Promotion;

use App\DataFixturesFactoryInterface\Promotion\PromotionActionDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class PromotionActionDataFixturesFactory extends DataFixturesFactory implements PromotionActionDataFixturesFactoryInterface
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
