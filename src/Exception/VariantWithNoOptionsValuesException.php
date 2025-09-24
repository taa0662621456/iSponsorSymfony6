<?php

namespace App\Exception;

final class VariantWithNoOptionsValuesException extends \Exception
{
    public function __construct()
    {
        parent::__construct('product_variant.cannot_generate_variants');
    }
}