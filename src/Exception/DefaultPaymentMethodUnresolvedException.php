<?php

namespace App\Exception;

class DefaultPaymentMethodUnresolvedException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Default payment method could not be resolved!');
    }
}