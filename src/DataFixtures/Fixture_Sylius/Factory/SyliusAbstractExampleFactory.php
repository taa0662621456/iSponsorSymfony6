<?php


namespace App\DataFixtures\Fixture_Sylius\Factory;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    abstract protected function configureOptions(OptionsResolver $resolver): void;
}
