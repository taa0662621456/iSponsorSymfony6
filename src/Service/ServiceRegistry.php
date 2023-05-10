<?php

namespace App\Service;

use App\Exception\ExistingServiceException;
use App\Exception\NonExistingServiceException;
use App\Interface\ServiceRegistryInterface;

class ServiceRegistry implements ServiceRegistryInterface
{
    /**
     * @psalm-var array<string, object>
     *
     * @var object[]
     */
    private array $services = [];

    /**
     * Interface or parent class which is required by all services.
     *
     * @var string
     */
    private string $className;

    /**
     * Human-readable context for these services, e.g. "grid field".
     *
     * @var string
     */
    private string $context;

    public function __construct(string $className = '', string $context = 'service')
    {
        $this->className = $className;
        $this->context = $context;
    }

    public function all(): array
    {
        return $this->services;
    }

    public function register(string $identifier, $service): void
    {
        if ($this->has($identifier)) {
            throw new ExistingServiceException($this->context, $identifier);
        }

        if (!$service instanceof $this->className) {
            throw new \InvalidArgumentException(sprintf('%s needs to be of type "%s", "%s" given.', ucfirst($this->context), $this->className, get_class($service)));
        }

        $this->services[$identifier] = $service;
    }

    public function unregister(string $identifier): void
    {
        if (!$this->has($identifier)) {
            throw new NonExistingServiceException($this->context, $identifier, array_keys($this->services));
        }

        unset($this->services[$identifier]);
    }

    public function has(string $identifier): bool
    {
        return isset($this->services[$identifier]);
    }

    public function get(string $identifier): object
    {
        if (!$this->has($identifier)) {
            throw new NonExistingServiceException($this->context, $identifier, array_keys($this->services));
        }

        return $this->services[$identifier];
    }
}
