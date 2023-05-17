<?php

namespace App\DataFixturesFactory\Taxation;

use App\DataFixturesFactoryInterface\Taxation\TaxationDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class TaxationDataFixturesFactory extends DataFixturesFactory implements TaxationDataFixturesFactoryInterface
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
