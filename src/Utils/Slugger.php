<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

use App\Interface\SlugGeneratorInterface;

/**
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class Slugger implements SlugGeneratorInterface
{
    public static function slugify(string $string): string
    {
        return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
    }

    public function generateSlug(string $text): string
    {
        // Приведение текста к нижнему регистру
        $text = mb_strtolower($text);

        // Замена пробелов и специальных символов на дефисы
        $text = preg_replace('/[\s\W-]+/', '-', $text);

        // Удаление повторяющихся дефисов
        $text = preg_replace('/-+/', '-', $text);

        // Удаление дефисов в начале и конце строки
        return trim($text, '-');
    }
}