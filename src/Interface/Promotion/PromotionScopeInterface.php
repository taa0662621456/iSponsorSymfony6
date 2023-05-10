<?php

namespace App\Interface\Promotion;

interface PromotionScopeInterface
{
    public function setType(mixed $type);

    public function setConfiguration(mixed $configuration);
}
