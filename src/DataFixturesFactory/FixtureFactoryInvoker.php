<?php

namespace App\DataFixturesFactory;

use App\Service\DataFixtures\DataFixturesFactory;
use App\Service\Object\ObjectFactory;

class FixtureFactoryInvoker
{
    private array $factories;

    public function __construct(ObjectFactory $objectFactory, DataFixturesFactory $fixtureFactory)
    {
        $this->factories = [
            ObjectFactory::class => $objectFactory,
            DataFixturesFactory::class => $fixtureFactory,
        ];
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $class, array $options = []): object
    {
        if (!isset($this->factories[$class])) {
            throw new \InvalidArgumentException(sprintf('Unsupported fixture class: %s', $class));
        }

        $factory = $this->factories[$class];

        return $factory->create($class, $options);
    }
}

