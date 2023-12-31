<?php


namespace App\Interface\DataFixturesInterface;

interface DataFixturesFactoryInterface
{
    /**
     * @param string $entityName
     * @param array $options
     * @return object
     */
    public function create(string $entityName, array $options = []): object;
}
