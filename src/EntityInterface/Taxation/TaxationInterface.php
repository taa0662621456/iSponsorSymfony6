<?php

namespace App\EntityInterface\Taxation;

interface TaxationInterface
{
    public function setFallbackLocale(int|string|null $array_key_first);

    public function getTranslations();
}
