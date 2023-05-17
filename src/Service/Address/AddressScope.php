<?php

namespace App\Service\Address;

class AddressScope
{
    public const SCOPE_ALL = 'all';
    public const SCOPE_COUNTRY = 'country';
    public const SCOPE_ZONE = 'zone';

    public static function getAllScopes(): array
    {
        return [
            self::SCOPE_ALL,
            self::SCOPE_COUNTRY,
            self::SCOPE_ZONE,
        ];
    }


}
