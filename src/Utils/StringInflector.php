<?php

namespace App\Utils;

class StringInflector
{
    public function capitalize(string $text): string
    {
        return ucfirst($text);
    }

    public function camelCase(string $text): string
    {
        $words = explode(' ', $text);
        $camelCaseWords = array_map('ucfirst', $words);
        return lcfirst(implode('', $camelCaseWords));
    }

    public function snakeCase(string $text): string
    {
        $words = explode(' ', $text);
        return implode('_', $words);
    }

    public static function nameToCode(string $name): string
    {
        // Удаление пробелов из имени
        $name = str_replace(' ', '', $name);

        // Преобразование имени в верхний регистр
        $name = strtoupper($name);

        // Получение первых трех символов имени
        return substr($name, 0, 3);
    }
}