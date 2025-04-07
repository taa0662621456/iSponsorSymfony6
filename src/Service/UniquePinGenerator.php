<?php

namespace App\Service;

use InvalidArgumentException;

class UniquePinGenerator
{
    private int $pinLength;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        private $generator,
        private $uniquenessChecker,
        int $pinLength,
    ) {
        Assert::greaterThanEq($pinLength, 1, 'The value of token length has to be at least 1.');
        $this->pinLength = $pinLength;
    }

    public function generate(): string
    {
        do {
            $pin = $this->generator->generateNumeric($this->pinLength);
        } while (!$this->uniquenessChecker->isUnique($pin));

        return $pin;
    }
}
