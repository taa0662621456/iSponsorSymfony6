<?php

namespace App\Service\Fixture;

use App\Interface\Fixture\FixtureFactoryInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFixtureFactory implements FixtureFactoryInterface
{
    protected Generator $faker;
    protected OptionsResolver $optionsResolver;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    abstract protected function configureOptions(OptionsResolver $resolver): void;

    /**
     * @throws \Exception
     */
    protected function getRandomStatus(array $statuses): string
    {
        return $statuses[random_int(0, count($statuses) - 1)];
    }
}
