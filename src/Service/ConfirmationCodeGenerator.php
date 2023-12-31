<?php

namespace App\Service;

class ConfirmationCodeGenerator
{
    public const RANDOM_STRING = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @throws \Exception
     */
    public function getConfirmationCode(): string
    {
        $stringLength = \strlen(self::RANDOM_STRING);
        $code = '';

        for ($i = 0; $i < $stringLength; $i++) {
            $code .= self::RANDOM_STRING[random_int(0, $stringLength - 1)];
        }

        return $code;
    }
}
