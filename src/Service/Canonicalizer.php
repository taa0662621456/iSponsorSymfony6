<?php

namespace App\Service;

final class Canonicalizer
{
    public function canonicalize(?string $string): ?string
    {
        return null === $string ? null : mb_convert_case($string, \MB_CASE_LOWER, mb_detect_encoding($string) ?: null);
    }
}
