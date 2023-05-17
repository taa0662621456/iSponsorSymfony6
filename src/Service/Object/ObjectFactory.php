<?php

namespace App\Service\Object;

use App\Interface\Object\ObjectFactoryInterface;

class ObjectFactory implements ObjectFactoryInterface
{
    private array $factories;

    public function __construct(array $factories = [])
    {
        $this->factories = $factories;
    }

    public function create(string $className, array $options = []): object
    {
        $factoryName = $this->getFactoryName($className);

        if (isset($this->factories[$factoryName])) {
            $factory = $this->factories[$factoryName];
            $this->setProperties($factory, $options);
            return $factory;
        }

        throw new \RuntimeException(sprintf('Factory for class "%s" not found.', $className));
    }

    private function getFactoryName(string $className): string
    {
        $namespaceParts = explode('\\', $className);
        $className = end($namespaceParts);
        return $className . 'Factory';
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
