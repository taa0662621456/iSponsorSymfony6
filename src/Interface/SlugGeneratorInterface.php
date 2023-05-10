<?php

namespace App\Interface;

interface SlugGeneratorInterface
{
    public function generateSlug(string $text): string;

}
