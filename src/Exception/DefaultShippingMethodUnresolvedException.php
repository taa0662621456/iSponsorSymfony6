<?php

namespace App\Exception;

final class DefaultShippingMethodUnresolvedException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Default shipping method could not be resolved!');
    }
}
