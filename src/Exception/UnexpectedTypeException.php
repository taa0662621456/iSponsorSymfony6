<?php

namespace App\Exception;

use InvalidArgumentException;
use function gettype;
use function is_object;

class UnexpectedTypeException extends InvalidArgumentException
{
    public function __construct($value, string $expectedType)
    {
        parent::__construct(sprintf(
            'Expected argument of type "%s", "%s" given.',
            $expectedType,
            is_object($value) ? $value::class : gettype($value),
        ));
    }
}
