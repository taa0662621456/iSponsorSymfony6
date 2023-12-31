<?php

namespace App\Service\System;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class ExceptionMappingResolver
{
    // https://blog.eazy-dev.com/2021/05/symfony-api-4/

    private array $mappings = [];

    private function addMapping(string $class, int $code, bool $hidden, bool $loggable): void
    {
        $this->mappings[$class] = new ExceptionMapping($code, $hidden, $loggable);
    }

    public function __construct(array $mappings)
    {
        foreach ($mappings as $class => $mapping) {
            if (empty($mapping['code'])) {
                throw new InvalidArgumentException('code is mandatory for class '.$class);
            }

            $this->addMapping(
                $class,
                $mapping['code'],
                $mapping['hidden'] ?? true,
                $mapping['loggable'] ?? false,
            );
        }
    }

    public function resolve(string $throwableClass): ?ExceptionMapping
    {
        $foundMapping = null;

        foreach ($this->mappings as $class => $mapping) {
            if ($throwableClass === $class || is_subclass_of($throwableClass, $class)) {
                $foundMapping = $mapping;
                break;
            }
        }

        return $foundMapping;
    }
}
