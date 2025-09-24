<?php

namespace App\Service;

interface IdempotencyServiceInterface
{
    public function run(?string $key, string $scope, callable $producer): array; // вернёт кэшированный ответ при повторе
}
