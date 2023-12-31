<?php

namespace App\Service\Product;

use Transliterator;
use App\Interface\SlugGeneratorInterface;

final class ProductSlugGenerator implements SlugGeneratorInterface
{
    public function generate(string $name): string
    {
        // Manually replacing apostrophes since Transliterator started removing them at v1.2.
        $name = str_replace('\'', '-', $name);

        return \Transliterator::transliterate($name);
    }

    public function generateSlug(string $text): string
    {
        // TODO: Implement generateSlug() method.
        return '';
    }
}
