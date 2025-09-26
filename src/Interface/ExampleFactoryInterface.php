<?php


namespace App\Interface;

interface ExampleFactoryInterface
{
    /**
     * @param array $options
     * @return object
     */
    public function create(array $options = []): object;
}
