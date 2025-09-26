<?php

namespace App\Interface;

interface DateTimeProviderInterface
{
    public function now(): \DateTimeInterface;
}
