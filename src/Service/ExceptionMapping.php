<?php

namespace App\Service;

class ExceptionMapping
{
    private int $code;

    private bool $hidden;

    private bool $loggable;

    public function __construct(int $code, bool $hidden = true, bool $loggable = false)
    {
        $this->code = $code;
        $this->hidden = $hidden;
        $this->loggable = $loggable;
    }

}
