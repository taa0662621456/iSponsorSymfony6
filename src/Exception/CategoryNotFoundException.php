<?php

namespace App\Exception;

use Exception;

class CategoryNotFoundException extends Exception
{
    public function __construct($message = "Category not found", $code = 0, Exception $previous = null)
    {
        // Если нужно, можно передать дополнительную информацию
        parent::__construct($message, $code, $previous);
    }

}
