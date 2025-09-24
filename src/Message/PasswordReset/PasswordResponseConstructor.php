<?php

namespace App\Message\PasswordReset;

class PasswordResponseConstructor
{
    public function __construct(public string $email, public string $localeCode)
    {
    }

}