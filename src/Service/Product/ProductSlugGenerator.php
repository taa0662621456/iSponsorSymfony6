<?php

namespace App\Service\Product;


final class ProductSlugGenerator
{
    public function generate(string $name): string
    {
        // Manually replacing apostrophes since Transliterate started removing them at v1.2.

        if (!class_exists(\Transliterator::class)) {
            throw new \RuntimeException('Transliterate extension is not installed.');
        }

        $name = str_replace('\'', '-', $name);



        $transliterate = \Transliterator::create('Any-Latin; Latin-ASCII');
        return $transliterate->transliterate($name);

    }

    public function generateSlug(string $text): string
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\-]/', '-', $text); // Заменяем неподходящие символы
        $text = preg_replace('/-+/', '-', $text);          // Убираем лишние дефисы
        return trim($text, '-');                           // Убираем дефисы по краям
    }

}
