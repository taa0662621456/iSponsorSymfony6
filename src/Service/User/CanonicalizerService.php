<?php

namespace App\Service\User;

class CanonicalizerService
{
    public function canonicalize(?string $value): ?string
    {
        return $value !== null ? mb_strtolower(trim($value)) : null;
    }
}
