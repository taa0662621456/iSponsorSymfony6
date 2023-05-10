<?php

namespace App\Factory;

use App\Service\Fixture\FixtureFactory;
use App\Service\Object\ObjectFactory;

class FactoryInvoker
{
    private array $factories;

    public function __construct(ObjectFactory $objectFactory, FixtureFactory $fixtureFactory)
    {
        $this->factories = [
            ObjectFactory::class => $objectFactory,
            FixtureFactory::class => $fixtureFactory,
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

