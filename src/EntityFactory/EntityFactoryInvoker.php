<?php

namespace App\EntityFactory;

use App\Service\Object\ObjectFactory;

class EntityFactoryInvoker
{
    private array $factories;

    public function __construct(ObjectFactory $objectFactory)
    {
        $this->factories = [
            ObjectFactory::class => $objectFactory,
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

