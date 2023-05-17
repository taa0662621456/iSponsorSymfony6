<?php

namespace App\DataFixturesFactory\Locale;

use App\DataFixturesFactoryInterface\Locale\LocaleDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;

class LocaleFixtureFactory extends ObjectFactory implements LocaleDataFixturesFactoryInterface
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

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }
}
