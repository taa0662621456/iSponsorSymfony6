<?php

namespace App\DataFixturesFactory\Product;

use App\DataFixturesFactoryInterface\Product\ProductDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class ProductDataFixturesFactory extends DataFixturesFactory implements ProductDataFixturesFactoryInterface
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
