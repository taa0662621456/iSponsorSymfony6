<?php

namespace App\Interface;

use App\Exception\ExistingServiceException;
use App\Exception\NonExistingServiceException;

interface ServiceRegistryInterface
{
    public function all(): array;

    /**
     * @param string $identifier
     * @param object $service
     *
     * @throws ExistingServiceException
     * @throws \InvalidArgumentException
     */
    public function register(string $identifier, object $service): void;

    /**
     * @throws NonExistingServiceException
     */
    public function unregister(string $identifier): void;

    public function has(string $identifier): bool;

    /**
     * @param string $identifier
     * @return object
     *
     * @throws NonExistingServiceException
     */
    public function get(string $identifier): object;

}