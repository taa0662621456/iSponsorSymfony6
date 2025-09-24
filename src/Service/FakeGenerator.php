<?php

namespace App\Service;

use Faker\Generator as FakerGenerator;

class FakeGenerator
{
    private FakerGenerator $faker;

    public function __construct(FakerGenerator $faker)
    {
        $this->faker = $faker;
    }

    public function generateRandomNumber(int $min, int $max): int
    {
        return $this->faker->numberBetween($min, $max);
    }

    public function generateRandomString(int $length = 10): string
    {
        return $this->faker->regexify("[A-Za-z0-9]{{$length}}");
    }

    public function generateRandomArrayElement(array $array)
    {
        return $this->faker->randomElement($array);
    }
}