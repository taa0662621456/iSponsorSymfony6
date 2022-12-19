<?php

namespace App\Account;

interface DateTimeProviderInterface
{
    public function now(): \DateTimeInterface;
}
