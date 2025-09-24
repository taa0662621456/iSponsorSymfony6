<?php

namespace App\Service\Security;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class PasswordGenerator
{
    private ComputerPasswordGenerator $generator;

    public function __construct()
    {
        $config = [
            'upper_case' => true,
            'lower_case' => true,
            'numbers' => true,
            'symbols' => true,
            'length' => '12'
        ];

        $this->generator = new ComputerPasswordGenerator();

        $this->generator
            ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, $config['upper_case'])
            ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, $config['lower_case'])
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, $config['numbers'])
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, $config['symbols'])
            ->setLength($config['length']);
    }

    public function generatePassword(): string
    {
        return $this->generator->generatePassword();
    }
}