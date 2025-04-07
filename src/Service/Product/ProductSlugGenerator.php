<?php

namespace App\Service\Product;


final class ProductSlugGenerator
{
    public function generate(string $name): string
    {
        // Manually replacing apostrophes since Transliterate started removing them at v1.2.
        $name = str_replace('\'', '-', $name);

        return (new \Transliterator)->transliterate($name);
    }

    public function generateSlug(string $text): string
    {
        // TODO: Implement generateSlug() method.
        return '';
    }
}
