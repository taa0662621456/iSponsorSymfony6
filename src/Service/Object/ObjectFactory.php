<?php

namespace App\Service\Object;

use App\Interface\Object\ObjectFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ObjectFactory implements ObjectFactoryInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function create(string $className, array $options = []): object
    {
        $factory = $this->resolveFactory($className);
        $this->setProperties($factory, $options);
        return $factory;
    }

    private function resolveFactory(string $className): object
    {
        if ($this->container->has($className)) {
            return $this->container->get($className);
        }

        throw new \RuntimeException(sprintf('Factory for class "%s" not found.', $className));
    }

    private function setProperties(object $object, array $options): void
    {
        foreach ($options as $property => $value) {
            $setter = 'set'.ucfirst($property);
            if (method_exists($object, $setter)) {
                $object->$setter($value);
            }
        }
    }
}
