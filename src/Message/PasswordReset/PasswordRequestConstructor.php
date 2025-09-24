<?php

namespace App\Message\PasswordReset;

class PasswordRequestConstructor
{
    public function __construct(public string $email)
    {
    }

}