<?php


namespace App\Interface\Fixture;

interface FixtureFactoryInterface
{
    /**
     * @param string $entityName
     * @param array $options
     * @return object
     */
    public function create(string $entityName, array $options = []): object;
}
