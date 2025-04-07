<?php

namespace App\Exception;

use Exception;

class DefaultPaymentMethodUnresolvedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Default payment method could not be resolved!');
    }
}
