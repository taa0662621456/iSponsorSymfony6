<?php

namespace App\DataFixturesFactory\Promotion;

use App\DataFixturesFactoryInterface\Promotion\PromotionDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class PromotionDataFixturesFactory extends DataFixturesFactory implements PromotionDataFixturesFactoryInterface
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

    public function isCouponBased()
    {
        // TODO: Implement isCouponBased() method.
    }
}
