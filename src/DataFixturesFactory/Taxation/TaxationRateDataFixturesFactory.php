<?php

namespace App\DataFixturesFactory\Taxation;

use App\DataFixturesFactoryInterface\Taxation\TaxationRateDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class TaxationRateDataFixturesFactory extends DataFixturesFactory implements TaxationRateDataFixturesFactoryInterface
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

    public function setCode(mixed $code)
    {
        // TODO: Implement setCode() method.
    }

    public function setName(mixed $name)
    {
        // TODO: Implement setName() method.
    }

    public function setAmount(mixed $amount)
    {
        // TODO: Implement setAmount() method.
    }

    public function setIncludedInPrice(mixed $included_in_price)
    {
        // TODO: Implement setIncludedInPrice() method.
    }

    public function setCalculator(mixed $calculator)
    {
        // TODO: Implement setCalculator() method.
    }

    public function setZone(mixed $zone)
    {
        // TODO: Implement setZone() method.
    }

    public function setCategory(mixed $category)
    {
        // TODO: Implement setCategory() method.
    }
}
