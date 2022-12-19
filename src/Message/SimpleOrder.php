<?php

namespace App\Message;

class SimpleOrder
{
    protected string $message;
    public function __construct(string $message)
    {
        $this->message = $message;
    }
    public function getMessage(): string
    {
        return $this->message;
    }

}
