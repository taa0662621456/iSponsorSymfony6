<?php

namespace App\Exception;

class CartNotFoundException extends \RuntimeException
{
    public function __construct(string $message = null, \Exception $previousException = null)
    {
        parent::__construct($message ?? 'Me was not able to figure out the current cart.', 0, $previousException);
    }
}
